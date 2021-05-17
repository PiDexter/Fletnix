<?php


namespace app\src;


class View
{
    public function renderView($view, $data = []): array|bool|string
    {
        // Haal de main layout op
        $layout = $this->layoutContent();
        $view = $this->renderOnlyView($view, $data);

        // Vervang alle {{var}} & {{key->value}} tags in de view
        $view = $this->replaceViewTags($view, $data);

        // Vervang de string "{{content}}" met de inhoud van de view file in de layout
        return str_replace("{{content}}", $view, $layout);
    }

    // Proces een tag bijvoorbeeld: {{name}}
    private function replaceViewTags($view, $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $view = $this->nestedViewTag($view, $key, $value);
            } else {
                $view = str_replace("{{" . $key . "}}", (string) $value, $view);
            }
        }
        return $view;
    }

    // Proces een nested tag bijvoorbeeld: {{user->name}}
    private function nestedViewTag($view, $parentName, $data)
    {
        foreach ($data as $key => $value) {
            $view = str_replace("{{" . $parentName . "->" . $key. "}}", (string) $value, $view);
        }
        return $view;
    }


    protected function layoutContent(): bool|string
    {

        // Bewaard alles in een string - ook wel: output buffer - voorkomt directe weergave
        ob_start();

        //  Haal de main layout
        include_once Application::$ROOT_DIR."/views/layout/main.php";

        // Returns de waarde (content in dit geval) die in de buffer zit en leegt vervolgens de output buffer
        return ob_get_clean();
    }

    public function renderOnlyView($view, $data): bool|string
    {

        // Zet parameter key als variable naam met als waarde de value
        extract($data);

        // Bewaar alles in een string - ook wel: output buffer - voorkomt directe weergave
        ob_start();
        //  Haal view op
        include_once Application::$ROOT_DIR."/views/$view.php";

        // Returns de waarde (content in dit geval) die in de buffer zit en leegt vervolgens de output buffer
        return ob_get_clean();
    }
}