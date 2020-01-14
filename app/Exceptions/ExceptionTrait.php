<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
* This trait does not come from Larvel.
* This trait is used for handling common not found errors
**/
trait ExceptionTrait
{
	public function apiException($request, $exception)
	{
		if($this->isMethodNotAllowedHttpException($exception)){
			return response()->json([
                'message' => 'The url is missing required parameter(s)!',
                'errors' => [
                	'parameters' => [
                		'Parameter(s) not found.'
                	]
                ],
                'code' => 422
            ], 422);
		}
		if($this->isModel($exception)){
            return response()->json([
                'message' => 'The data with certain id does not exist.',
                'errors' => [
                	'Model(id)' => [
                		'Model is not found.'
                	]
                ],
                'code' => 404
            ], 404);
        }
        if($this->isHttpException($exception)){
            return response()->json([
            	'message' => 'Please check the url',
                'errors' => [
                	'Route' => [
                		'Incorrect route. The route is not found.'
                	]
                ],
                'code' => 404
            ], 404);
        }
	}

	public function isMethodNotAllowedHttpException($exception)
	{
		return $exception instanceof MethodNotAllowedHttpException;
	}

	public function isModel($exception)
	{
		return $exception instanceof ModelNotFoundException;
	}

	public function isHttpException($exception)
	{
		return $exception instanceof NotFoundHttpException;
	}
	
}