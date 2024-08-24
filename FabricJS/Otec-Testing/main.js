let canvas = new fabric.Canvas('canvas', {
  width: window.innerWidth,
  height: window.innerHeight,
})

// Fungsi untuk memeriksa intersection antara dua garis
function doLinesIntersect(line1Start, line1End, line2Start, line2End) {
  const det =
    (line1End.x - line1Start.x) * (line2End.y - line2Start.y) -
    (line1End.y - line1Start.y) * (line2End.x - line2Start.x)
  if (det === 0) {
    return false // Garis-garis tersebut paralel
  }

  const lambda =
    ((line2End.y - line2Start.y) * (line2End.x - line1Start.x) +
      (line2Start.x - line2End.x) * (line2End.y - line1Start.y)) /
    det
  const gamma =
    ((line1Start.y - line1End.y) * (line2End.x - line1Start.x) +
      (line1End.x - line1Start.x) * (line2End.y - line1Start.y)) /
    det

  return 0 < lambda && lambda < 1 && 0 < gamma && gamma < 1
}

// Fungsi untuk memeriksa apakah dua objek Fabric.js bertumpang tindih berdasarkan garis-garis tepi
function isIntersectingLines(obj1, obj2) {
  const aCoords1 = obj1.aCoords
  const aCoords2 = obj2.aCoords

  const lines1 = [
    [aCoords1.tl, aCoords1.tr],
    [aCoords1.tr, aCoords1.br],
    [aCoords1.br, aCoords1.bl],
    [aCoords1.bl, aCoords1.tl],
  ]

  const lines2 = [
    [aCoords2.tl, aCoords2.tr],
    [aCoords2.tr, aCoords2.br],
    [aCoords2.br, aCoords2.bl],
    [aCoords2.bl, aCoords2.tl],
  ]

  for (let i = 0; i < lines1.length; i++) {
    for (let j = 0; j < lines2.length; j++) {
      if (
        doLinesIntersect(lines1[i][0], lines1[i][1], lines2[j][0], lines2[j][1])
      ) {
        return true
      }
    }
  }

  return false
}

const rectangle = new fabric.Rect({
  left: 120,
  top: 120,
  width: 50,
  height: 50,
  angle: 0,
  fill: 'blue',
  scaleX: 2,
  scaleY: 2,
})

// Membuat objek textbox
const netText = new fabric.Textbox('4 x 4', {
  fontSize: 20,
  originX: 'center',
  originY: 'center',
  left: rectangle.left + rectangle.width / 2,
  top: rectangle.top + rectangle.height / 2,
  width: 50,
  height: 50,
})

const net = new fabric.Group([rectangle, netText])

// Titik-titik untuk polyline
const points = [
  { x: 1006.4672508683886, y: 191.6543868771988 },
  { x: 1355.4190223415, y: 82.96285028585619 },
  { x: 1650.0258457983075, y: 403.3168528708659 },
  { x: 1507.0128247027694, y: 620.6999260535509 },
  { x: 1035.0698550874959, y: 517.7289966512263 },
]

// Membuat objek polygon
const polygon = new fabric.Polygon(points, {
  left: -326.6973,
  top: -273.7866,
  fill: 'rgba(50, 255, 0, 0.26)',
  stroke: '#00FF67',
  strokeWidth: 9.836065573770492,
  hasControls: true,
  id: 'section_1a1b2628-ec88-4a26-be80-a7f99f1b74bb',
  layerType: 'section',
  pageId: 'f535e0f4-f999-4de3-84f3-fc95e1a43529',
})

// Membuat objek textbox
const polygonText = new fabric.Textbox('', {
  left: 9.0575,
  top: -125.8534,
  width: 65.5738,
  height: 74.0984,
  fill: 'rgb(0,0,0)',
  visible: false,
  backgroundColor: 'white',
  fontFamily: 'Times New Roman',
  fontSize: 65.57377049180329,
  textAlign: 'center',
  hasControls: true,
  showTextBoxBorder: true,
  id: 'a08b0ba5-b785-4682-ad49-15eaba395b35',
})

// Membuat grup dengan polygon dan textbox
const section = new fabric.Group([polygon, polygonText], {
  left: 300.5492,
  top: 78.0448,
  width: 653.3947,
  height: 547.5731,
  hasControls: true,
  id: 'section_9ea5ec03-6ed7-4dfd-aa31-74ea7e5e5062',
  layerType: 'section',
  pageId: 'f535e0f4-f999-4de3-84f3-fc95e1a43529',
  scaleX: 0.4,
  scaleY: 0.4,
})

// Menambahkan grup ke canvas
canvas.add(rectangle)
canvas.add(net)
canvas.add(section)

// Lakukan pengecekan intersection setelah objek ditambahkan ke canvas dan di-render
canvas.renderAll()

canvas.on('object:modified', function (e) {
  const intersecting = isIntersectingLines(section, net)
  console.log('Intersecting:', intersecting)
})
