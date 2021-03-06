<?php
use report\organization\Personal;
use report\user\Session;
$account='';
$actual_link = strtok((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]","?");
// $listA=array();
$str='';
$columnName=array();
$orgNO = isset($g['orgNO'])?$g['orgNO']:'';
if ($orgNO!=''){
    if (null!=SESSION::get('account')){
        $account=SESSION::get('account');
        $result = Personal::dualSystemLevel($account,$orgNO);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $str=$result['data'];
            $columnName=$result['columnName'];
        }
    }
}else {
    if (null!=SESSION::get('account')){
        $account=SESSION::get('account');
        $result = Personal::dualSystemLevel($account);
        if ($result['code']==0){
            //         $listA = $result['data'];
            $str=$result['data'];
            $columnName=$result['columnName'];
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Org Chart Static</title>
<meta name="description" content="A larger org chart with an Overview and searching capability." />
<!-- Copyright 1998-2017 by Northwoods Software Corporation. -->
<meta charset="UTF-8">
<style type="text/css">
  #myOverviewDiv {
    position: absolute;
    width:200px;
    height:100px;
    top: 10px;
    left: 10px;
    background-color: aliceblue;
    z-index: 300; /* make sure its in front */
    border: solid 1px blue;
  }
</style>
<script src="./gojs/release/go.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<script src="./gojs/assets/js/goSamples.js"></script>  <!-- this is only for the GoJS Samples framework -->
<script id="code">
  function init() {
    //if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var $ = go.GraphObject.make;  // for conciseness in defining templates
    myDiagram =
      $(go.Diagram, "myDiagramDiv",  // the DIV HTML element
        {
          // Put the diagram contents at the top center of the viewport
          initialDocumentSpot: go.Spot.TopCenter,
          initialViewportSpot: go.Spot.TopCenter,
          // OR: Scroll to show a particular node, once the layout has determined where that node is
          //"InitialLayoutCompleted": function(e) {
          //  var node = e.diagram.findNodeForKey(28);
          //  if (node !== null) e.diagram.commandHandler.scrollToPart(node);
          //},
          layout:
            $(go.TreeLayout,  // use a TreeLayout to position all of the nodes
              {
                treeStyle: go.TreeLayout.StyleLastParents,
                // properties for most of the tree:
                angle: 90,
                layerSpacing: 80,
                // properties for the "last parents":
                alternateAngle: 0,
                alternateAlignment: go.TreeLayout.AlignmentStart,
                alternateNodeIndent: 20,
                alternateNodeIndentPastParent: 1,
                alternateNodeSpacing: 20,
                alternateLayerSpacing: 40,
                alternateLayerSpacingParentOverlap: 1,
                alternatePortSpot: new go.Spot(0.001, 1, 20, 0),
                alternateChildPortSpot: go.Spot.Left
              })
        });
    // define Converters to be used for Bindings
    function theNationFlagConverter(nation) {
      return "https://www.nwoods.com/go/Flags/" + nation.toLowerCase().replace(/\s/g, "-") + "-flag.Png";
    }
    function theInfoTextConverter(info) {
      var str = "";
      if (info.title) str += "等級: " + info.title;
      if (info.headOf) str += "\n\n層級: " + info.headOf;
      if (typeof info.boss === "number") {
        var bossinfo = myDiagram.model.findNodeDataForKey(info.boss);
        if (bossinfo !== null) {
          str += "\n\安置於: " + bossinfo.name;
        }
      }
      return str;
    }
    // define the Node template
    myDiagram.nodeTemplate =
      $(go.Node, "Auto",
        // the outer shape for the node, surrounding the Table
        $(go.Shape, "Rectangle",
          { stroke: null, strokeWidth: 0 },
                                                  /* reddish if highlighted, blue otherwise */
          new go.Binding("fill", "isHighlighted", function(h) { return h ? "#F44336" : "#A7E7FC"; }).ofObject()),
        // a table to contain the different parts of the node
        $(go.Panel, "Table",
          { margin: 6, maxSize: new go.Size(100, NaN) },
          // the two TextBlocks in column 0 both stretch in width
          // but align on the left side
          $(go.RowColumnDefinition,
            {
              column: 0,
              stretch: go.GraphObject.Horizontal,
              alignment: go.Spot.Left
            }),
          // the name
          $(go.TextBlock,
            {
              row: 0, column: 0,
              maxSize: new go.Size(160, NaN), margin: 2,
              font: "500 16px Roboto, sans-serif",
              alignment: go.Spot.Top
            },
            new go.Binding("text", "name")),
          // the country flag
          $(go.Picture,
            {
              row: 0, column: 1, margin: 2,
              imageStretch: go.GraphObject.Uniform,
              alignment: go.Spot.TopRight
            },
            // only set a desired size if a flag is also present:
            new go.Binding("desiredSize", "nation", function(){ return new go.Size(34, 26) }),
            new go.Binding("source", "nation", theNationFlagConverter)),
          // the additional textual information
          $(go.TextBlock,
            {
              row: 1, column: 0, columnSpan: 2,
              font: "12px Roboto, sans-serif",
//              click: function(e, obj) {window.open(obj.part.data.url)}
              click: function(e, obj) {window.open(<?php echo "'".$actual_link."?orgNO='";?>+obj.part.data.url,"_self")}
            },
            new go.Binding("text", "", theInfoTextConverter))
        )  // end Table Panel
      );  // end Node
    // define the Link template, a simple orthogonal line
    myDiagram.linkTemplate =
      $(go.Link, go.Link.Orthogonal,
        { corner: 5, selectable: false },
        $(go.Shape, { strokeWidth: 3, stroke: "#424242" } ));  // dark gray, rounded corner links
    // set up the nodeDataArray, describing each person/position
    var nodeDataArray = [
        <?php echo $str; ?>
    ];
    // create the Model with data for the tree, and assign to the Diagram
    myDiagram.model =
      $(go.TreeModel,
        { nodeParentKeyProperty: "boss",  // this property refers to the parent node data
          nodeDataArray: nodeDataArray });
    // Overview
    myOverview =
      $(go.Overview, "myOverviewDiv",  // the HTML DIV element for the Overview
        { observed: myDiagram, contentAlignment: go.Spot.Center });   // tell it which Diagram to show and pan
  }
  // the Search functionality highlights all of the nodes that have at least one data property match a RegExp
  function searchDiagram() {  // called by button
    var input = document.getElementById("mySearch");
    if (!input) return;
    input.focus();
    myDiagram.startTransaction("highlight search");
    if (input.value) {
      // search four different data properties for the string, any of which may match for success
      // create a case insensitive RegExp from what the user typed
      var regex = new RegExp(input.value, "i");
      var results = myDiagram.findNodesByExample({ name: regex },
                                                 { nation: regex },
                                                 { title: regex },
                                                 { headOf: regex });
      myDiagram.highlightCollection(results);
      // try to center the diagram at the first node that was found
      if (results.count > 0) myDiagram.centerRect(results.first().actualBounds);
    } else {  // empty string only clears highlighteds collection
      myDiagram.clearHighlighteds();
    }
    myDiagram.commitTransaction("highlight search");
  }
</script>
</head>
<body onload="init()">
<h3>ERP網站功能顯示-安置組織（層次）</h3>
<div id="sample" style="position: relative;">
  <div id="myDiagramDiv" style="background-color: white; border: solid 1px black; width: 100%; height: 1000px"></div>
  <div id="myOverviewDiv"></div> <!-- Styled in a <style> tag at the top of the html page -->
</div>
</body>
</html>
