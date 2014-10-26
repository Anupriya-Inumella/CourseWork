/* A Bison parser, made by GNU Bison 3.0.2.  */

/* Bison interface for Yacc-like parsers in C

   Copyright (C) 1984, 1989-1990, 2000-2013 Free Software Foundation, Inc.

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.  */

/* As a special exception, you may create a larger work that contains
   part or all of the Bison parser skeleton and distribute that work
   under terms of your choice, so long as that work isn't itself a
   parser generator using the skeleton or a modified version thereof
   as a parser skeleton.  Alternatively, if you modify or redistribute
   the parser skeleton itself, you may (at your option) remove this
   special exception, which will cause the skeleton and the resulting
   Bison output files to be licensed under the GNU General Public
   License without this special exception.

   This special exception was added by the Free Software Foundation in
   version 2.2 of Bison.  */

#ifndef YY_YY_PARSER_TAB_H_INCLUDED
# define YY_YY_PARSER_TAB_H_INCLUDED
/* Debug traces.  */
#ifndef YYDEBUG
# define YYDEBUG 0
#endif
#if YYDEBUG
extern int yydebug;
#endif

/* Token type.  */
#ifndef YYTOKENTYPE
# define YYTOKENTYPE
  enum yytokentype
  {
    TYPE_INT = 258,
    TYPE_BOOL = 259,
    VOID = 260,
    CONSTANT_INTEGER = 261,
    CONSTANT_CHARACTER = 262,
    CONSTANT_STRING = 263,
    CONSTANT_BOOLEAN = 264,
    IDENTIFIER = 265,
    OPEN_BRACE = 266,
    CLOSED_BRACE = 267,
    OPEN_SQR_BRACKET = 268,
    CLOSED_SQR_BRACKET = 269,
    OPEN_PARANTHESIS = 270,
    CLOSED_PARANTHESIS = 271,
    IF = 272,
    ELSE = 273,
    FOR = 274,
    BREAK = 275,
    CONTINUE = 276,
    RETURN = 277,
    SEMI_COLON = 278,
    COMMA = 279,
    CALLOUT = 280,
    OP_EQUAL = 281,
    OP_NOT = 282,
    OP_BINARY = 283,
    OP_ARITH_ASSIGN = 284,
    OP_MINUS = 285,
    CLASS = 286,
    PROGRAM = 287
  };
#endif

/* Value type.  */
#if ! defined YYSTYPE && ! defined YYSTYPE_IS_DECLARED
typedef union YYSTYPE YYSTYPE;
union YYSTYPE
{
#line 22 "parser.y" /* yacc.c:1909  */

    string *str;
    Array<Decl*> *declList;
    Decl *decl;
    FieldDecl *fieldDecl;
    MethodDecl *methodDecl;
    Field *field;
    Array<Field*> *fieldList;
    Array<Param*> *paramList;
    Param *param;
    Array<Statement*> *block; 
    Statement *stmnt;
    Expr *expr;
    Array<Expr*> *exprList;

#line 103 "parser.tab.h" /* yacc.c:1909  */
};
# define YYSTYPE_IS_TRIVIAL 1
# define YYSTYPE_IS_DECLARED 1
#endif


extern YYSTYPE yylval;

int yyparse (void);

#endif /* !YY_YY_PARSER_TAB_H_INCLUDED  */
