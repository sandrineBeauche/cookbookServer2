<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\UnitQuery as BaseUnitQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'unit' table.
 */
class UnitQuery extends BaseUnitQuery
{
    use \cookbook\RetrieveOrderedByName;
    
    protected static $retrieveAllFields = array('id', 'name');
}
