<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\CountryQuery as BaseCountryQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'country' table.
 *
 */
class CountryQuery extends BaseCountryQuery
{
    use \cookbook\RetrieveOrderedByName;
    
    protected static $retrieveAllFields = array('id', 'name', 'flag');
}
