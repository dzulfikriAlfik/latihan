let canvas = new fabric.Canvas('canvas', {
  width: window.innerWidth,
  height: window.innerHeight,
})

let line
let mouseDown = false

const addingLineBtn = document.getElementById('adding-line-button')
let addingLineBtnCliked = false

addingLineBtn.addEventListener('click', activateAddingLine)

function activateAddingLine() {
  if (!addingLineBtnCliked) {
    addingLineBtnCliked = true

    canvas.on('mouse:down', startAddingLine)
    canvas.on('mouse:move', startDrawingLine)
    canvas.on('mouse:up', stopDrawingLine)

    canvas.selection = false
    canvas.hoverCursor = 'auto'
  }
}

function startAddingLine(o) {
  mouseDown = true

  if (mouseDown) {
    let pointer = canvas.getPointer(o.e)

    line = new fabric.Line([pointer.x, pointer.y, pointer.x, pointer.y], {
      id: 'added-line',
      stroke: 'red',
      strokeWidth: 3,
      selectable: false,
    })

    canvas.add(line)
    canvas.requestRenderAll()
  }
}

function startDrawingLine(o) {
  if (mouseDown) {
    let pointer = canvas.getPointer(o.e)

    line.set({
      x2: pointer.x,
      y2: pointer.y,
    })

    canvas.requestRenderAll()
  }
}

function stopDrawingLine() {
  mouseDown = false
  line.setCoords()
}

let deactivateAddingShapeBtn = document.getElementById(
  'deactivate-adding-shape'
)

deactivateAddingShapeBtn.addEventListener('click', deactivateAddingShape)

function deactivateAddingShape() {
  canvas.off('mouse:down', startAddingLine)
  canvas.off('mouse:move', startDrawingLine)
  canvas.off('mouse:up', stopDrawingLine)

  canvas.getObjects().forEach((o) => {
    if (o.id === 'added-line') {
      o.set({
        selectable: true,
      })
    }
  })

  canvas.hoverCursor = 'all-scroll'
}
