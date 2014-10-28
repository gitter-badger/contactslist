

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


Installation and configuration
------------------------------

#. Make sure that you’re using at least TYPO3 4.0.0 and PHP 5.1.0.

#. Make sure that you have installed the extension
   **static\_info\_tables** .

#. Make sure that you have installed the extension **oelib** .

#. Install the extension and its dependencies.

#. In you main TS template, include this extension’s static setup under
   *Include static (from extensions)* .

#. The extension provides its own basic set of CSS styles (which work
   best if you're already using a CSS-based design). These stylesheets
   usually get included automatically. However, if your have set
   *disableAllHeaderCode = 1* and want to use the provided stylesheet *,*
   you need to include the stylesheet
   *typo3conf/ext/contactslist/pi1/contactslist\_pi1.css* manually into
   your page header.

#. Create a system folder (page) that will hold all the contacts data.
   (Usually, you need only one page, but there are scenarios where you
   might want to use more than one page, e.g.to have more than one user
   group tending to the data.)

#. Give the user group that will enter the data write access to that
   folder.

#. Select or create one or more pages that will have the plug-in.

#. Add a plug-in to the page(s).

#. As the plug-in type, select “Contacts List”.

#. As a starting point (starting page), add the system folder you
   created.

#. The default setup should work out of the box. If you want to change
   something, configure the plug-in to your liking using the template TS
   setup.

#. To configure the plug-in language, you need to set  *two* values in
   your TS setup: *config.language* and  *page.config.language.*

#. Enter the data in the back end using  *Web -> List.*


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   UpgradingFromVersion030/Index
   Reference/Index

