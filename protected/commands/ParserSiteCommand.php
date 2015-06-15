<?php

class ParserSiteCommand extends CConsoleCommand {

    public function actionIndex() {
        $name = get_class($this) . __FUNCTION__;
        $model = Commands::model()->find("name=:name", array(":name" => $name));

        if (!$model) {
            $model = new Commands;
            $option = Options::model()->find("status=:status", array(":status" => "read"));

            if ($option) {
                $model->name = $name;
                $model->status = 'run';
                $model->save();
                
                $parserSite = new ParserSite($option->domain);
                $parserSite->run();
                $option->status = 'done';
                $option->save();
                $model->delete();
            }
        }
    }

}
