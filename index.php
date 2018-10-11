<?php
include_once 'app/config.inc.php';
include_once 'app/ConnectionFullFillment.inc.php';
include_once 'app/SessionControl.inc.php';
include_once '../rfp/app/Redirection.inc.php';

include_once '../rfq/app/Conexion.inc.php';

include_once '../rfq/app/Usuario.inc.php';
include_once '../rfq/app/RepositorioUsuario.inc.php';

include_once '../rfq/app/Rfq.inc.php';
include_once 'app/RepositorioRfqFullFillment.inc.php';

include_once '../rfq/app/Item.inc.php';
include_once 'app/RepositorioItemFullFillment.inc.php';

include_once '../rfq/app/Provider.inc.php';
include_once 'app/RepositorioProviderFullFillment.inc.php';

include_once '../rfq/app/Subitem.inc.php';
include_once 'app/RepositorioSubitemFullFillment.inc.php';

include_once '../rfq/app/ProviderSubitem.inc.php';
include_once 'app/RepositorioProviderSubitemFullFillment.inc.php';

include_once '../rfp/app/User.inc.php';
include_once 'app/UserFullFillmentRepository.inc.php';
include_once '../rfp/app/UserValidator.inc.php';
include_once 'app/UserLoginValidatorFullFillment.inc.php';
include_once '../rfp/app/UserSignInValidator.inc.php';

$url_components = parse_url($_SERVER['REQUEST_URI']);
$route = $url_components['path'];

$parts_route = explode('/', $route);
$parts_route = array_filter($parts_route);
$parts_route = array_slice($parts_route, 0);
$chosen_route = 'views/404.php';

if($parts_route[0] == 'fullfillment'){
  if(count($parts_route) == 1){
    $chosen_route = 'views/home.php';
  }else if(count($parts_route) == 2){
    switch ($parts_route[1]) {
      case 'profile':
        $current_manager = '';
        $chosen_route = 'views/profile.php';
        break;
      case 'generate_user':
        $chosen_route = 'tools/generate_user.php';
        break;
      default:
        break;
    }
  }else if(count($parts_route) == 3){
    switch ($parts_route[1]) {
      case 'profile':
        switch ($parts_route[2]) {
          case 'rfq_team':
            $current_manager = 'rfq_team';
            $chosen_route = 'views/profile.php';
            break;
          default:
            break;
        }
        break;
      default:
        break;
    }
  }
}
include_once $chosen_route;
?>
