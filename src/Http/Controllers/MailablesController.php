<?php

namespace Qoraiche\MailEclipse\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use App\Models\General\EmailTemplate;
use Qoraiche\MailEclipse\MailEclipse;

class MailablesController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('maileclipse.allowed_environments', ['local'])),
            403,
            'Environment Not Allowed'
      );
    }

    public function toMailablesList()
    {
        return redirect()->route('mailableList');
    }

    public function index()
    {
        $mailables = MailEclipse::getMailables();

        $mailables = (null !== $mailables) ? $mailables->sortBy('name') : collect([]);

        return view(MailEclipse::$view_namespace.'::sections.mailables', compact('mailables'));
    }

    public function createMailable(Request $request)
    {
        return view(MailEclipse::$view_namespace.'::createmailable');
    }

    public function generateMailable(Request $request)
    {
        return MailEclipse::generateMailable($request);
    }

    public function viewMailable($name)
    {
        $mailable = MailEclipse::getMailable('name', $name);

        if ($mailable->isEmpty()) {
            return redirect()->route('mailableList');
        }

        $resource = $mailable->first();

        return view(MailEclipse::$view_namespace.'::sections.view-mailable')->with(compact('resource'));
    }

    public function editMailable($name)
    {
        $templateData = MailEclipse::getMailableTemplateData($name);

        if (! $templateData) {
            return redirect()->route('viewMailable', ['name' => $name]);
        }

        return view(MailEclipse::$view_namespace.'::sections.edit-mailable-template', compact('templateData', 'name'));
    }

    public function templatePreviewError()
    {
        return view(MailEclipse::$view_namespace.'::previewerror');
    }

    public function parseTemplate(Request $request)
    {
        $template = $request->has('template') ? $request->template : false;
        $slug = $request->viewpath;
        $isTemplate = $request->boolean('template');
        $markdown = preg_replace('/((?!{{.*?-)(&gt;)(?=.*?}}))/', '>', $request->markdown);

        // ref https://regexr.com/4dflu
        $bladeRenderable = preg_replace('/((?!{{.*?-)(&gt;)(?=.*?}}))/', '>', $request->markdown);

        if ($isTemplate) {
        $template = EmailTemplate::where('template_slug', $slug)->first();

        if ($template) {
            $template->template = $markdown;
            $template->save();

            return response()->json(['status' => 'ok']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Template not found'], 404);
        }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid request'], 400);
    }

    public function previewMarkdownView(Request $request)
    {
        return MailEclipse::previewMarkdownViewContent(false, $request->markdown, $request->name, false, $request->namespace);
    }

    public function previewMailable($name)
    {
        $mailable = MailEclipse::getMailable('name', $name);

        if ($mailable->isEmpty()) {
            return redirect()->route('mailableList');
        }

        $resource = $mailable->first();

        if (! is_null(MailEclipse::handleMailableViewDataArgs($resource['namespace']))) {
            // $instance = new $resource['namespace'];
            //
            $instance = MailEclipse::handleMailableViewDataArgs($resource['namespace']);
        } else {
            $instance = new $resource['namespace'];
        }

        if (collect($resource['data'])->isEmpty()) {
            return 'View not found';
        }

        $view = ! is_null($resource['markdown']) ? $resource['markdown'] : $resource['data']->view;

        if (view()->exists($view)) {
            try {
                $html = $instance;

                return $html->render();
            } catch (\ErrorException $e) {
                return view(MailEclipse::$view_namespace.'::previewerror', ['errorMessage' => $e->getMessage()]);
            }
        }

        return view(MailEclipse::$view_namespace.'::previewerror', ['errorMessage' => 'No template associated with this mailable.']);
    }

    public function delete(Request $request)
    {
        $mailableFile = config('maileclipse.mailables_dir').'/'.$request->mailablename.'.php';

        if (file_exists($mailableFile)) {
            unlink($mailableFile);

            return response()->json([
                'status' => 'ok',
            ]);
        }

        return response()->json([
            'status' => 'error',
        ]);
    }
}
