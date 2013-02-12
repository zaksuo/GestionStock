/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var a = chr(97);
var i = chr(105);
var m = chr(109);
var t = chr(116);
var M = chr(77);
var R = chr(82);
var S = chr(86);
var GS = chr(29); // 1D en hexa
var ESC = chr(27); // 1B en hexa
var AROBASE = chr(64);
var RESET = "\x1B\x40";
var CUT = "\x1d\x56\x42\x00";
var CUT2 = ESC + i;
var CUT3 = ESC + m;
var CUT4 = GS + S; 
var FR_CHAR_SET = ESC + t + 4;

function chr(i) {
    return String.fromCharCode(i);
} 

function uni(i) {
    return String.charCodeAt(i);
}

function findPrinter() {
    var applet = document.jzebra;
    if (applet != null) {
        // Searches for locally installed printer with "zebra" in the name
        applet.findPrinter("Metapace T-3");
    }

    monitorFinding();
}

function monitorFinding() {
    var applet = document.jzebra;
    if (applet != null) {
        if (!applet.isDoneFinding()) {
            window.setTimeout('monitorFinding()', 100);
        } else {
            var printer = applet.getPrinter();
            alert(printer == null ? "Imprimante non détectée" : "Imprimante \"" + printer + "\" détectée");
        }
    } else {
        alert("Applet non chargé");
    }
}

function print( ticket ) {
    alert(ticket);
    var applet = document.jzebra;
    if (applet != null) {
        // Send characters/raw commands to applet using "append"
        // Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
        // 42 caractères par ligne font A et 56 font B
        
        // Initialisation de l'imprimante ESC @
        applet.append("\x1B\x40");
        //applet.append(ESC+AROBASE); 
         
        // Sélection de du characterset francais ESC R 1
        applet.append(ESC+R+"1");
        
//        applet.append("******************************************\n");
//        applet.append("*            La Dame de Quilt            *\n");
//        applet.append("*           32 rue de l'église           *\n");
//        applet.append("*          77250 Morêt sur Loing         *\n");
//        applet.append("******************************************\n");
        applet.append(ticket);
        applet.setEndOfDocument("P1\n");
        applet.append("\x1d\x56\x42\x00");
        //applet.append("\x1d\x56\x42\x00");
//        applet.append("A590,1600,2,3,1,1,N,\"jZebra " + applet.getVersion() + " sample.html\"\n");
//        applet.append("A590,1570,2,3,1,1,N,\"Testing the print() function\"\n");

        // Send characters/raw commands to printer
        applet.print();
    }

    monitorPrinting();
}

function cutPaper() {
    document.jzebra.append(CUT); // cut paper
}

function test() {
    var chaine1 = "La Dame de Quilt";
    var chaine2 = "32 rue de l'église";
    var chaine3 = "77250 Morêt sur Loing";
    
    var toprint1 = "";
    var toprint2 = "";
    var toprint3 = "";
    
    for(i = 0; i < chaine1.length ; i++ ) {
        toprint1 += "\\x" + chaine1.charCodeAt(i).toString(16);
    }
    toprint1 += "\n";
    
    for(i = 0; i < chaine2.length ; i++ ) {
        toprint2 += "\\x" + chaine2.charCodeAt(i).toString(16);
    }
    toprint2 += "\n";
    
    for(i = 0; i < chaine3.length ; i++ ) {
        toprint3 += "\\x" + chaine3.charCodeAt(i).toString(16);
    }
    toprint3 += "\n";
    
    document.write( toprint1 + "<br /><br />" );
    document.write( toprint2 + "<br /><br />" );
    document.write( toprint3 + "<br /><br />" );
    
    return toprint1 + toprint2 + toprint3; 

}