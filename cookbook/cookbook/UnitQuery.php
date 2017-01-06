<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\UnitQuery as BaseUnitQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'unit' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class UnitQuery extends BaseUnitQuery
{
    use \cookbook\RetrieveOrderedByName;
    
    protected static $retrieveAllFields = array('id', 'name');
}