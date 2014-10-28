

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


Upgrading from version 0.3.0
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

#. Make sure that you’re using at least TYPO3 4.0.0 and PHP 5.1.0.

#. Make sure that you have installed the extension *static\_info\_tables*
   in the latest version.

#. Make sure that you have installed the extension *oelib* in the latest
   version.

#. The CSS file now is set via constants. If you are using a custom CSS
   file, please set it in the constants editor.

#. Upgrade this extension.

#. In you main TS template, include this extension’s static setup under
   *Include static (from extensions)* .

#. Uninstall the extension  *sr\_static\_info* unless it’s still needed
   by another extension.

