# crm
Simple crm

DATABASE NOTES

psql
\l
\q
\dt *.

\c database_name
pg_hba.conf
postgresql.conf



host    all             all             192.168.64.1            ident
host    all             all             192.168.64.1            md5


CREATE TABLE public."user"
(
    id serial NOT NULL,
    name character varying(250),
    email character varying(250),
    mobile_no bigint,
    address text,
    PRIMARY KEY (id)
)

  INSERT INTO user (id,name,email,mobile_no,address)
  VALUES (1, 'Paul', 32, 1212124, 'trzaska');

___________________________

CREATE TABLE public."user"
(
    id serial NOT NULL,
    name character varying(250),
    email character varying(250),
    mobile_no bigint,
    address text,
    PRIMARY KEY (id)
)

  INSERT INTO user (id,name,age,email)
  VALUES (1, 'Paul', 32, 1212124, 'trzaska');

CREATE TABLE users1 (
    id int,
    name varchar,
    age int,
    email varchar,
    PRIMARY KEY  (id)
);

ALTER DEFAULT PRIVILEGES IN SCHEMA public
GRANT INSERT, UPDATE, DELETE ON TABLES TO urosss;

________________

ESCAPE FUNCTIONS NOTES

htmlspecialchars

& (ampersand)	&amp;
" (double quote)	&quot;, unless ENT_NOQUOTES is set
' (single quote)	&#039; (for ENT_HTML401) or &apos; (for ENT_XML1, ENT_XHTML or ENT_HTML5), but only when ENT_QUOTES is set
< (less than)	&lt;
> (greater than)	&gt;



pg_escape_string

It returns an escaped string in the PostgreSQL format without quotes.




\’ – To escape ‘ within single quoted string.
\” – To escape “ within double quoted string.
\\ – To escape the backslash.
\$ – To escape $.
\n – To add line breaks between string.
\t – To add tab space.
\r – For carriage return.


_______________________________



str_replace(find,replace,string,count)

function escape_for_sql(string $s) {
return str_replace('\'', '\'\'', $s);
}

$name = escape_for_sql($_POST["name"]);
$tries = $_POST["tries"];
$route = escape_for_sql($_POST["route"]);
$climbed_on = $_POST["climbed_on"];
$comment = escape_for_sql($_POST["comment"]);



if(strcmp("", $name) == 0 or strcmp("", $route) == 0) {
 trigger_error($desc." failed! must not be empty");
 } else if (!is_numeric($tries) or $tries <= 0) {
        trigger_error($desc." failed! must be a positive number");
    } else if ($editing and !is_numeric($id)){
        trigger_error($desc." failed! ID must be a number");
   } else if (!preg_match("/^\d{4}-\d\d-\d\d$/", $climbed_on)){
         trigger_error($desc." failed! Date must be in format yyyy-mm-dd");
     }




    $query = "";
    if($editing) {

‪         $query = "update climbs set name='" . $name . "', tries=" . $tries .
              ", route='" . $route . "', climbed_on='" . $climbed_on . "', comment='" .
              $comment . "' where id=" . $id . ";";
     } else {
         $query = "insert into climbs(name, route, tries, climbed_on, comment)" .
             "values('" . $name . "', '" . $route . "', " . $tries . ", '" .
              $climbed_on . "', '" . $comment . "');";
      }
