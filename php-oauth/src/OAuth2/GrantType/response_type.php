<?php
namespace OAuth2\GrantType;


/**
 * Authorization code  Grant Type Validator
 */
class improvedgrants implements IGrantType
{
    /**
     * Defines the Grant Type
     *
     * @var string  Defaults to 'response_type'.
     */
    const GRANT_TYPE = 'response_type';

    /**
     * Adds a specific Handling of the parameters
     *
     * @return array of Specific parameters to be sent.
     * @param  mixed  $parameters the parameters array (passed by reference)
     */
    public function validateParameters(&$parameters)
    {
        if (!isset($parameters['response_type']))
        {
            throw new InvalidArgumentException(
                'The \'code\' parameter must be defined for the Authorization Code grant type',
                InvalidArgumentException::MISSING_PARAMETER
            );
        }
        elseif (!isset($parameters['redirect_uri']))
        {
            throw new InvalidArgumentException(
                'The \'redirect_uri\' parameter must be defined for the Authorization Code grant type',
                InvalidArgumentException::MISSING_PARAMETER
            );
        }
    }
}
