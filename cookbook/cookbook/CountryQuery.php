<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\CountryQuery as BaseCountryQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'country' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class CountryQuery extends BaseCountryQuery
{
    use \cookbook\RetrieveOrderedByName;
    
    protected static $retrieveAllFields = array('id', 'name', 'flag');
}
