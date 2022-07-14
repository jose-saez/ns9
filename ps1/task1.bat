set PHP=C:/bin/php-8.0.1-nts-Win32-vs16-x86/php.exe 
set PHP=C:\bin\UniServerZ\core\php74\php.exe
set SVN="C:/Program Files/TortoiseSVN/bin/svn.exe"

REM %PHP% -f C:/Users/jsm52l/Dropbox/src/php/bot/task1.php
REM %PHP% -f C:\bin\src\php\bot\task1.php
%PHP% -f C:\git\ns9\php\bot\task1.php
REM %PHP% -f C:\bin\src\php\bot\task2-consultas.php
%PHP% -f C:\git\ns9\php\bot\task2-consultas.php

REM C:\cygwin64\bin\shuf.exe -n1 C:/dat/anasis.txt |palbot
C:\cygwin64\bin\shuf.exe -n1 C:/dat/dics/dicts_idp/FRENCH.txt |palbot
REM C:\cygwin64\bin\shuf.exe -n1 c:/dat/dics/th_en_US_v2.dat |palbot
REM C:\cygwin64\bin\shuf.exe -n1 c:/dat/dics/th_es_ANY_v2.dat |palbot
REM C:\cygwin64\bin\shuf.exe -n1 c:/dat/dics/th_es_ES_v2.dat |palbot
REM C:\cygwin64\bin\shuf.exe -n1 C:/dat/dics/Oxford_English_Dictionary.txt |palbot
REM C:\cygwin64\bin\grep.exe -Ev "^$" c:/dat/dics/Oxford_English_Dictionary.txt |c:\cygwin64\bin\shuf.exe -n1 |palbot

%SVN% up c:\svn |palbot
%SVN% up C:\svn_sms\sauco |palbot
