<?php
namespace Student\Controller;

class RequestControllerException extends \Exception {}

class RequestController {

    protected $module;
    protected $action;
    protected $postParams = [];
    protected $template;
//    protected $response = [];

    /**
     * Constructor to validate the request
     */
    public function __construct()
    {
        $this->template = new \HTML_Template_Sigma(ROOT_DIR . '/View/Template/');
        $this->template->setErrorHandling(PEAR_ERROR_DIE);

        try {
            $this->validateRequest();
        } catch (RequestControllerException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Validate request parameters
     *
     * @throws ApiRequestHandlerException
     */
    private function validateRequest()
    {
        if (!filter_input(INPUT_GET, 'path')) {
            throw new RequestControllerException('Invalid URL');
        }

        $params = explode('/', filter_input(INPUT_GET, 'path'));

        if (count($params) > 3) {
            throw new RequestControllerException('Invalid URL');
        }
        $this->module = array_shift($params);
        $this->action = implode('_', array_filter($params));
        $this->setPostParams();
    }
//           $student = new \Student\Model\Entity\Student();
//           $student->get();

    /**
     * Fetch and set the post input parameter values
     */
    protected function setPostParams()
    {
        $this->postParams = !empty($_POST) ? $_POST : [];
    }

    /**
     * Get the post parameters
     *
     * @return array Post parameters
     */
//           $student = new \Student\Model\Entity\Student();
//           $student->get();
    public function getPostParams()
    {
        return $this->postParams;
    }

    public function processRequest()
    {

        if ($this->module == 'login' || $this->module == '') {
            $loginController = new \Student\Controller\LoginController($this);
           
            if ($this->action == 'forgotpassword') {
                $response = $loginController->forgotPassword();
            } elseif ($this->action == 'resetpassword') {
                $response = $loginController->resetPassword();
            } elseif ($this->action == 'signup') {
                $response = $loginController->signup();
            } else {
                $response = $loginController->authenticate();
            }
        }
        if ($response) {
            $this->finalResponse($response);
        }
    }

    public function finalResponse($output)
    {
        $this->template->loadTemplateFile('layout.html');
        $this->template->setVariable([
            'CONTENT' => $output,
            'BACKGROUND_CLASS' => empty($this->action) ? $this->module : $this->action
        ]);
        echo $this->template->get();
        exit;
    }
}