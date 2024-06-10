<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Trusthub
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Trusthub\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Serialize;


class ComplianceRegistrationInquiriesList extends ListResource
    {
    /**
     * Construct the ComplianceRegistrationInquiriesList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(
        Version $version
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        ];

        $this->uri = '/ComplianceInquiries/Registration/RegulatoryCompliance/GB/Initialize';
    }

    /**
     * Create the ComplianceRegistrationInquiriesInstance
     *
     * @param string $endUserType
     * @param string $phoneNumberType
     * @param array|Options $options Optional Arguments
     * @return ComplianceRegistrationInquiriesInstance Created ComplianceRegistrationInquiriesInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $endUserType, string $phoneNumberType, array $options = []): ComplianceRegistrationInquiriesInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'EndUserType' =>
                $endUserType,
            'PhoneNumberType' =>
                $phoneNumberType,
            'BusinessIdentityType' =>
                $options['businessIdentityType'],
            'BusinessRegistrationAuthority' =>
                $options['businessRegistrationAuthority'],
            'BusinessLegalName' =>
                $options['businessLegalName'],
            'NotificationEmail' =>
                $options['notificationEmail'],
            'AcceptedNotificationReceipt' =>
                Serialize::booleanToString($options['acceptedNotificationReceipt']),
            'BusinessRegistrationNumber' =>
                $options['businessRegistrationNumber'],
            'BusinessWebsiteUrl' =>
                $options['businessWebsiteUrl'],
            'FriendlyName' =>
                $options['friendlyName'],
            'AuthorizedRepresentative1FirstName' =>
                $options['authorizedRepresentative1FirstName'],
            'AuthorizedRepresentative1LastName' =>
                $options['authorizedRepresentative1LastName'],
            'AuthorizedRepresentative1Phone' =>
                $options['authorizedRepresentative1Phone'],
            'AuthorizedRepresentative1Email' =>
                $options['authorizedRepresentative1Email'],
            'AuthorizedRepresentative1DateOfBirth' =>
                $options['authorizedRepresentative1DateOfBirth'],
            'AddressStreet' =>
                $options['addressStreet'],
            'AddressStreetSecondary' =>
                $options['addressStreetSecondary'],
            'AddressCity' =>
                $options['addressCity'],
            'AddressSubdivision' =>
                $options['addressSubdivision'],
            'AddressPostalCode' =>
                $options['addressPostalCode'],
            'AddressCountryCode' =>
                $options['addressCountryCode'],
            'EmergencyAddressStreet' =>
                $options['emergencyAddressStreet'],
            'EmergencyAddressStreetSecondary' =>
                $options['emergencyAddressStreetSecondary'],
            'EmergencyAddressCity' =>
                $options['emergencyAddressCity'],
            'EmergencyAddressSubdivision' =>
                $options['emergencyAddressSubdivision'],
            'EmergencyAddressPostalCode' =>
                $options['emergencyAddressPostalCode'],
            'EmergencyAddressCountryCode' =>
                $options['emergencyAddressCountryCode'],
            'UseAddressAsEmergencyAddress' =>
                Serialize::booleanToString($options['useAddressAsEmergencyAddress']),
            'FileName' =>
                $options['fileName'],
            'File' =>
                $options['file'],
        ]);

        $payload = $this->version->create('POST', $this->uri, [], $data);

        return new ComplianceRegistrationInquiriesInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Trusthub.V1.ComplianceRegistrationInquiriesList]';
    }
}
