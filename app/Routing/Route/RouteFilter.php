<?php
// RouteFilter.php file in app/Routing/Route/

App::uses('CakeRoute', 'Routing/Route');

class RouteFilter extends CakeRoute {

    /**
    * Parses a string url into an array. If a controller_prefix key is found it will be appended to the
    * controller parameter
    *
    * @param string $url The url to parse
    * @return mixed false on failure, or an array of request parameters
    */
    public function parse($url) {

        $params = parent::parse($url);

        // CheckPoint :
//        debug($params);

        if (!$params) {
            return false;
        }

        if (isset($params['pass'][2]))
        {
            $params['controller'] = $params['pass'][0];
            $params['action'] = $params['pass'][1];
            $params['pass'] = array($params['pass'][2]);
        }
        else if (isset($params['pass'][1]))
        {
            $params['controller'] = $params['pass'][0];
            $params['action'] = $params['pass'][1];
        }
        else if (isset($params['pass'][0]))
        {
            $params['controller'] = 'users';
            $params['action'] = 'login';

            $params['userGroup'] = isset($params['pass'][0]) ? $params['pass'][0] : '';
        }
        else
        {
            $params['controller'] = 'users';
            $params['action'] = 'login';
        }

        // CheckPoint :
//        debug($params);

        return $params;
    }
}

?>