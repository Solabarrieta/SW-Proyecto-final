<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <HTML>
            <style>
                TD, TH {
                    margin: 25px 0;
                    font-size: 0.9em;
                    font-family: sans-serif;
                    padding: 6px;
                    border: solid 2px #c1e9f6;
                }
                TABLE {
                    border-collapse: collapse;
                }
            </style>
            <BODY>
                <FONT SIZE="2" COLOR="black" FACE="Verdana">
                    <H2>PREGUNTAS EN EL FICHERO XML</H2>
                </FONT>
                <TABLE bgcolor='#9cc4e8'>
                    <THEAD>
                        <TR>
                            <TH>Correo</TH>
                            <TH>Enunciado</TH>
                            <TH>Respuesta correcta</TH>
                            <TH>Respuestas incorrectas</TH>
                            <TH>Tema</TH>
                        </TR>
                    </THEAD>
                    <xsl:for-each select="assessmentItems/assesmentItem">
                        <TR>
                            <TD>
                                <xsl:value-of select="@author"/>
                                <BR/>
                            </TD>
                            <TD>
                                <xsl:value-of select="itemBody/p"/>
                                <BR/>
                            </TD>
                            <TD>
                                <P align="center">
                                    <xsl:value-of select="correctResponse/response"/>
                                    <BR/>
                                </P>
                            </TD>
                            <TD>
                                <UL>
                                    <xsl:for-each select="incorrectResponses/response">
                                        <li>
                                            <xsl:value-of select="text()"/>
                                        </li>
                                    </xsl:for-each>                                   
                                </UL>
                            </TD>
                            <TD>
                                <xsl:value-of select="@subject"/>
                                <BR/>
                            </TD>
                        </TR>
                    </xsl:for-each>
                </TABLE>
            </BODY>
        </HTML>
    </xsl:template>
</xsl:stylesheet>
