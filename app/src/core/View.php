<?php


namespace app\src\core;


class View
{
    /**
     * Render a view by replacing the view file content with {{content}} in main layout
     * @param string $view
     * @param array $data
     * @return array|bool|string
     */
    public function renderView(string $view, array $data = []): array|bool|string
    {
        $layout = $this->layoutContent();
        $view = $this->renderOnlyView($view, $data);
        $view = $this->replaceViewTags($view, $data);
        $view = $this->renderPagination($view, $data);
        $view = $this->removeEmptyTags($view);

        return str_replace("{{content}}", $view, $layout);
    }

    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    private function replaceViewTags(string $view, array $data): string
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

    /**
     * @param string $view
     * @return string
     */
    private function removeEmptyTags(string $view): string
    {
        return preg_replace('/{{(.*?)}}/', '', $view);
    }

    /**
     * @param string $view
     * @param string $parentName
     * @param array $data
     * @return string
     */
    private function nestedViewTag(string $view, string $parentName, array $data): string
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

    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    private function renderPagination(string $view, array $data): string
    {
        $paginationView = $this->renderOnlyView('layout/components/pagination', $data);
        return str_replace("@pagination", (string) $paginationView, $view);
    }

    /**
     * @return string
     */
    private function layoutContent(): string
    {
        // Bewaard alles in een string - ook wel: output buffer - voorkomt directe weergave
        ob_start();

        //  Haal de main layout
        include_once Application::$ROOT_DIR."/views/layout/main.php";

        // Returns de waarde (content in dit geval) die in de buffer zit en leegt vervolgens de output buffer
        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    private function renderOnlyView(string $view, array $data): string
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