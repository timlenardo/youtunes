$.fn.dataTableExt.oApi.fnGetAdjacentTr  = function ( oSettings, nTr, bNext )
{
    /* Find the node's position in the aoData store */
    var iCurrent = oSettings.oApi._fnNodeToDataIndex( oSettings, nTr );
      
    /* Convert that to a position in the display array */
    var iDisplayIndex = $.inArray( iCurrent, oSettings.aiDisplay );
    if ( iDisplayIndex == -1 )
    {
        /* Not in the current display */
        return null;
    }
      
    /* Move along the display array as needed */
    iDisplayIndex += (typeof bNext=='undefined' || bNext) ? 1 : -1;
      
    /* Check that it within bounds */
    if ( iDisplayIndex < 0 || iDisplayIndex >= oSettings.aiDisplay.length )
    {
        /* There is no next/previous element */
        return null;
    }
      
    /* Return the target node from the aoData store */
    return oSettings.aoData[ oSettings.aiDisplay[ iDisplayIndex ] ].nTr;
};