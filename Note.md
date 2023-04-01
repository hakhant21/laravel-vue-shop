## Check same vendor at a time
function isCartFromSameVendor($orderitems) {
    $vendors = [];

    foreach($orderitems as $orderitem) {
        $vendors[] = $orderitem->vendor_id;
    }

    $uniqueVendors = array_unique($vendors);

    return count($uniqueVendors) === 1;
}

