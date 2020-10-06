<?php


class Renderer //faire du rendu
{

	//https://www.youtube.com/watch?v=JfZmAszMI80
    /**
     * Display an HTML template by injecting $variables
     *
     * @param string $path
     * @param array $variables
     * @return void
     */
    public static function render(string $path, array $variables = []): void
    {
        extract($variables);

		ob_start();

		require('views/templates/' . $path . '.html.php');
		//var_dump($pageContent);
        $pageContent = ob_get_clean();

        require('views/templates/layout.html.php');
	}
	
	public static function ajaxRender(array $variables = []):void
	{
		extract($variables);

		ob_start();

		$ajaxContent = ob_get_clean();
	}
}
