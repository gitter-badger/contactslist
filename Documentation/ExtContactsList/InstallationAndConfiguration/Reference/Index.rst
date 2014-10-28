.. include:: Images.txt

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Reference
^^^^^^^^^

You can configure the plug-in using flexforms of the front end plug-in
your TS template setup for plugin.tx\_contactslist\_pi1. *property =
value.*

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         templateFile
   
   Data type
         String
   
   Description
         location of the template file
   
   Default
         EXT:contactslist/pi1/contactslist\_pi1.html


.. container:: table-row

   Property
         class\_h3
   
   Data type
         String
   
   Description
         CSS class for the item headings (will be automatically prefixed with
         *tx-contactslist-pi1-* )
   
   Default


.. container:: table-row

   Property
         class\_table
   
   Data type
         String
   
   Description
         CSS class for the item table (will be automatically prefixed with
         *tx-contactslist-pi1-* )
   
   Default


.. container:: table-row

   Property
         class\_td1
   
   Data type
         String
   
   Description
         CSS class for the table row headings cell (will be automatically
         prefixed with  *tx-contactslist-pi1-* )
   
   Default
         rowHeading


.. container:: table-row

   Property
         class\_td2
   
   Data type
         String
   
   Description
         CSS class for the table row data cell (will be automatically prefixed
         with  *tx-contactslist-pi1-* )
   
   Default


.. container:: table-row

   Property
         class\_inputcountry
   
   Data type
         String
   
   Description
         CSS class for the country selector (will be automatically prefixed
         with  *tx-contactslist-pi1-* )
   
   Default


.. container:: table-row

   Property
         class\_inputzipcode
   
   Data type
         String
   
   Description
         CSS class for the ZIP code text input (will be automatically prefixed
         with  *tx-contactslist-pi1-* )
   
   Default


.. container:: table-row

   Property
         class\_submitbutton
   
   Data type
         String
   
   Description
         CSS class for the submit button (will be automatically prefixed with
         *tx-contactslist-pi1-* )
   
   Default


.. container:: table-row

   Property
         defaultCountry
   
   Data type
         String
   
   Description
         ISO alpha3 code for the country that is selected by default(leave
         empty to have nothing selected)
   
   Default
         DEU


.. container:: table-row

   Property
         onchangeCountryselect
   
   Data type
         String
   
   Description
         onchange attribute for the country select(usually doesn't need to be
         changed)
   
   Default
         onchange="javascript:this.form.submit();"


.. container:: table-row

   Property
         hideFields
   
   Data type
         String
   
   Description
         comma-separated list of fields that should not be shown on the front
         endallowed values: *intro, inputcountry, inputzipcode,
         submitbutton,contactperson, address1, address2, zipcode, city,
         country, zipprefixes, phone, fax, mobile, homepage,
         email,resultbrowser*
   
   Default
         country,zipprefixes,resultbrowser


.. ###### END~OF~TABLE ######

[tsref:plugin.tx\_contactslist\_pi1]


Setup for the list view
"""""""""""""""""""""""

For the list view, there are some additional configuration option that
can only be set using the TS setup (not with flexforms) in the form
plugin.tx\_contactslist\_pi1.listView. *property = value.*

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         results\_at\_a\_time
   
   Data type
         integer
   
   Description
         the number of contacts that will be displayed per page (currently not
         used)
   
   Default
         10


.. container:: table-row

   Property
         maxPages
   
   Data type
         integer
   
   Description
         how many pages should be displayed in the list view page navigation
   
   Default
         5


.. container:: table-row

   Property
         orderBy
   
   Data type
         string
   
   Description
         which DB field is used for the default sorting in the list view
   
   Default
         company


.. container:: table-row

   Property
         descFlag
   
   Data type
         boolean
   
   Description
         the default sort order in the list view: 0 = ascending, 1 = descending
   
   Default
         0


.. ###### END~OF~TABLE ######

[tsref:plugin.tx\_realty\_pi1.listView]


Constants for the Contacts List front-end plug-in in plugin.tx\_contactslist\_pi1
"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

You can configure the plug-in using your TS template constant in the
form plugin.tx\_contactslist\_pi1. *property = value.*

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         Property:
   
   Data type
         Data type:
   
   Description
         Description:
   
   Default
         Default:


.. container:: table-row

   Property
         cssFile
   
   Data type
         string
   
   Description
         location of the CSS file (set as empty to not include the file)
   
   Default
         EXT:contactslist/pi1/contactslist\_pi1.css


.. ###### END~OF~TABLE ######

|img-3| EXT: Contacts List - 4


