<html>
    <head>
        <title>
            GET ALL
        </title>
    </head>
    <body>
        <center>
            <a href="controlar2.apk">Click Here For Download</a>
            <br><br>
            <p>
                char c;<br>
void setup() {<br>
  Serial.begin(9600);<br>
  pinMode(12,OUTPUT);<br>
}<br>
void loop() {<br>
  c=Serial.read();<br>
  switch(c)    // WE CAN USE MULTIPLE COMMAND<br>
  {<br>
    case 'a':<br>
    digitalWrite(12,1);<br>
    break;<br>
    case 'b':<br>
    digitalWrite(12,0);<br>
    break;<br>
  }<br>
}<br>
            </p>
        </center>
    </body>
</html>