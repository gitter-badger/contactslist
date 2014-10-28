

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


FAQ
^^^


Where can I find the ISO alpha3 code for a country?
"""""""""""""""""""""""""""""""""""""""""""""""""""

At the `Unicode online data site
<http://www.unicode.org/onlinedat/countries.html>`_ .


Which fields are displayed in the front end?
""""""""""""""""""""""""""""""""""""""""""""

The fields that are not empty and that are not hidden via TS setup.


How does the ZIP prefix list work?
""""""""""""""""""""""""""""""""""

It's a list of numbers (separated by commas or spaces) that should
match the beginning of a ZIP code which is entered on the front end.

For example, if an office servers people from ZIP areas starting with
50, 531, 532, 54, and 56, the following should be in the  *ZIP
prefixes* field:

50,531,532,54,55,56

The order of the prefixes doesn't matter.


How can I configure the search for contacts in one country only?
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

Hide the ZIP code field using the TS setup.


How can I get the whole list (for all countries) to display?
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

This is not possible.


Why are the contacts from Germany displayed as default?
"""""""""""""""""""""""""""""""""""""""""""""""""""""""

If you want to start with a blank list and no country selected, you
can set:plugin.tx\_contactslist\_pi1.defaultCountry =in your TS setup.


Why is the drop-down-list of countries so short?
""""""""""""""""""""""""""""""""""""""""""""""""

It lists only the countries that have a contact in them.

