<?php

  class AwesomeRegexBuilder{

    public static $_expression = "";

    public static $_modifiers = "";

    public static $charactersToEscape = ['/'];

    public static function get(){

      return "/" . self::$_expression . "/" . self::$_modifiers;

    }

    // Line Markers

    public static function startOfLine(){

        self::$_expression .= "^";

        return new static;

    }

    public static function endOfLine(){

        self::$_expression .= "$";

        return new static;
    }

    // White Space Markers

    public static function whiteSpace(){

        self::$_expression .= "\s";

        return new static;

    }

    public static function wordBoundary(){

        self::$_expression .= "\b";

        return new static;

    }

    // Charater Markers

    public static function escapeCharacters($args){

      foreach(self::$charactersToEscape as $each){

        $args = str_replace($each, '\\' . $each, $args);

      }

      return $args;

    }

    public static function anyCharacter(){

        self::$_expression .= ".";

        return new static;

    }

    public static function characters($arg){

        $arg = self::escapeCharacters($arg);

        self::$_expression .= "(?:$arg)";

        return new static;

    }

    public static function digit(){

        self::$_expression .= "\d";

        return new static;

    }

    public static function alphaDigitUnderScore(){

      self::$_expression .= "\w";

      return new static;

    }

    public static function punctuation(){

      self::$_expression .= "[^\w\d\s]";

      return new static;

    }

    public static function alpha(){

      self::$_expression .= "[a-zA-Z]";

      return new static;

    }

    public static function upperCase(){

      self::$_expression .= "[A-Z]";

      return new static;

    }

    public static function lowerCase(){

      self::$_expression .= "[a-z]";

      return new static;

    }

    // Quantity Marker

    public static function zeroOrOne(){

      self::$_expression .= "?";

      return new static;

    }

    public static function zeroOrMore(){

      self::$_expression .= "*";

      return new static;

    }

    public static function oneOrMore(){

      self::$_expression .= "+";

      return new static;

    }

    public static function exactly($arg){

      self::$_expression .= '{' . $arg . '}';

      return new static;

    }

    public static function exactlyOrMore($arg){

      self::$_expression .= '{' . $arg . ',}';

      return new static;

    }

    public static function between($arg1,$arg2){

      self::$_expression .= '{' . $arg1 . ',' . $arg2 . '}';

      return new static;

    }

    // Start Block

    public static function block(){

      self::$_expression .= '(';

      return new static;

    }

    public static function endBlock(){

      self::$_expression .= ')';

      return new static;

    }

    public static function inRange($arg){

        self::$_expression .= '[' . $arg . ']';

        return new static;

    }

    public static function or(){

        self::$_expression .= '|';

        return new static;

    }

    public static function notInRange($arg){

        self::$_expression .= '[^' . $arg . ']';

        return new static;

    }

    // modifiers

    public static function caseInsensitive(){

      self::$_modifiers .= 'i';

      return new static;

    }

    public static function global(){ // find all, dont return the first match

      self::$_modifiers .= 'g';

      return new static;

    }

    public static function multiLine(){ // tells the parser that this is a multiline preg,, hence ^ and $ will match each line and not just the ends of the string

      self::$_modifiers .= 'm';

      return new static;

    }

  }
