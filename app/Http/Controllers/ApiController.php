<?php 

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller 
{
  //const HTTP_NOT_FOUND = 404

  /**
   * [$statusCode description]
   * @var integer
   */
  protected $statusCode = 200;

    /**
     * Gets the value of statusCode.
     *
     * @return mixed
     */
    public function getstatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the value of statusCode.
     *
     * @param mixed $statusCode the statu code
     *
     * @return self
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * [responseNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function responseNotFound($message = 'Not Found!')
    {
      return $this->setstatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * [respondInternalError description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondInternalError($message = 'Internal Error!')
    {
      return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * [respondCreated description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondCreated($message = 'Lesson successfully created.')
    {
        return $this->setStatusCode(201)->respondWithError($message);
    }

    /**
     * [respondInvalidRequest description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondInvalidRequest($message = 'Parameters failed validation for a lesson.')
    {
      return $this->setStatusCode(422)->respondWithError($message);
    }

    /**
     * [respond description]
     * @param  [type] $data    [description]
     * @param  array  $headers [description]
     * @return [type]          [description]
     */
    public function respond($data, $headers = [])
    {
      return response()->json($data, $this->getstatusCode(), $headers);
    }

    /**
     * [respondWithError description]
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    public function respondWithError($message)
    {
      return $this->respond([
        'error' => [
          'message' => $message,
          'status_code' => $this->getstatusCode()
        ] 
      ]);
    }
}