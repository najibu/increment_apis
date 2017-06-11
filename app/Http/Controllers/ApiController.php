<?php 

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller 
{
  /**
   * [$statuCode description]
   * @var integer
   */
  protected $statuCode = 200;

    /**
     * Gets the value of statuCode.
     *
     * @return mixed
     */
    public function getStatuCode()
    {
        return $this->statuCode;
    }

    /**
     * Sets the value of statuCode.
     *
     * @param mixed $statuCode the statu code
     *
     * @return self
     */
    protected function setStatuCode($statuCode)
    {
        $this->statuCode = $statuCode;

        return $this;
    }

    public function responseNotFound($message = 'Not Found!')
    {
      return $this->setStatuCode(404)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
      return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respond($data, $headers = [])
    {
      return response()->json($data, $this->getStatuCode(), $headers);
    }

    public function respondWithError($message)
    {
      return $this->respond([
        'error' => [
          'message' => $message,
          'status_code' => $this->getStatuCode()
        ] 
      ]);
    }
}