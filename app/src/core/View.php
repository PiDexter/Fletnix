<?php


namespace app\src\core;


class View
{

    // Render view content in een layout file via {{content}}
    public function renderView($view, $data = []): array|bool|string
    {
        // Haal de main layout op
        $layout = $this->layoutContent();
        $view = $this->renderOnlyView($view, $data);

        // Vervang alle {{var}} & {{key->value}} tags in de view
        $view = $this->replaceViewTags($view, $data);
        $view = $this->renderPagination($view, $data);

        $view = $this->removeEmptyTags($view);

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
                $view = str_replace("{{" . $key . "}}", $value, $view);
            }
        }
        return $view;
    }


    // Remove all {{string}} that have no value
    private function removeEmptyTags($view): array|string|null
    {
        return preg_replace('/{{(.*?)}}/', '', $view);
    }

    // Proces een nested tag bijvoorbeeld: {{user->name}}
    private function nestedViewTag($view, $parentName, $data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!is_array($value)) {
                    $view = str_replace("{{" . $parentName . "->" . $key. "}}", $value, $view);
                }
            }
        }
        return $view;
    }

    protected function renderPagination($view, $data): array|string
    {
        $paginationView = $this->renderOnlyView('layout/components/pagination', $data);
        return str_replace("@pagination", (string) $paginationView, $view);
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
        extract($data, EXTR_OVERWRITE);

        // Bewaar alles in een string - ook wel: output buffer - voorkomt directe weergave
        ob_start();
        //  Haal view op
        include_once Application::$ROOT_DIR."/views/$view.php";

        // Returns de waarde (content in dit geval) die in de buffer zit en leegt vervolgens de output buffer
        return ob_get_clean();
    }
}