### 27 September 2018 - Version 0.1.12:
 - Symfony 4 support

### 18 October 2017 - Version 0.1.11:
 - Remove duplicate event class
 - Do not return sending result - force implementations to listen to the send event instead

### 18 October 2017 - Version 0.1.10:
 - Naming conventions improved
 - Dispatch event on message send
 - Removed lock file

### 17 October 2017 - Version 0.1.9:
 - Add message body and recipient to SmsResultItem
 - Return instance of SmsResultItemInterface when sending

### 10 October 2017 - Version 0.1.8:
 - Fix paragraph
 - Add missing argument
 - Fix typo
 - Version bump to 0.1.8
 - Added event subscriber example to docs

### 10 October 2017 - Version 0.1.7:
 - Improved some class names for clarity
 - Simplified event name constants
 - Add method requirements to routing to only allow HTTP POSTs

### 10 October 2017 - Version 0.1.6:
 - Added EsendexEventDispatcher OptOut endpoint
 - Switched routing to YML format
 - Removed dependency on FrameworkExtraBundle

### Version 0.1.0
 - Define default value for delivery_override option
 - Correct namespace typos
 - Complete 'delivery_override' functionality
 - Updated licence
 - Initial commit

