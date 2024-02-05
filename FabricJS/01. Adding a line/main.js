let canvas = new fabric.Canvas('canvas', {
  width: window.innerWidth,
  height: window.innerHeight,
})

let line
let arrowHead1
let mouseDown = false

const addingLineBtn = document.getElementById('adding-line-button')
const addingSingleArrowLineBtn = document.getElementById(
  'adding-single-arrow-line-button'
)

let addingLineBtnCliked = false
let addingSingleArrowLineBtnCliked = false

addingSingleArrowLineBtn.addEventListener(
  'click',
  activateAddingSingleArrowLine
)

function activateAddingSingleArrowLine() {
  if (!addingSingleArrowLineBtnCliked) {
    addingSingleArrowLineBtnCliked = true

    canvas.on({
      'mouse:down': startAddingSingleArrowLine,
      'mouse:move': startDrawingSingleArrowLine,
      'mouse:up': stopDrawingSingleArrowLine,
    })

    canvas.selection = false
    canvas.hoverCursor = 'auto'

    objectSelectability(false)
  }
}

function startAddingSingleArrowLine(o) {
  mouseDown = true

  if (mouseDown) {
    let pointer = canvas.getPointer(o.e)

    line = new fabric.Line([pointer.x, pointer.y, pointer.x, pointer.y], {
      id: 'added-single-arrow-line',
      stroke: 'red',
      strokeWidth: 3,
      selectable: false,
      hasControls: false,
    })

    arrowHead1 = new fabric.Polygon(
      [
        { x: 0, y: 0 },
        { x: -20, y: -10 },
        { x: -20, y: 10 },
      ],
      {
        id: 'arrow-head',
        stroke: 'red',
        strokeWidth: 3,
        fill: 'red',
        selectable: false,
        hasControls: false,
        top: pointer.y,
        left: pointer.x,
        originX: 'center',
        originY: 'center',
      }
    )

    canvas.add(line, arrowHead1)
    canvas.requestRenderAll()
  }
}

function startDrawingSingleArrowLine(o) {
  if (mouseDown) {
    let pointer = canvas.getPointer(o.e)

    line.set({
      x2: pointer.x,
      y2: pointer.y,
    })

    arrowHead1.set({
      left: pointer.x,
      top: pointer.y,
    })

    let x1 = line.x1
    let y1 = line.y1
    let x2 = pointer.x
    let y2 = pointer.y

    let verticalHeight = Math.abs(y2 - y1)
    let horizontalWidth = Math.abs(x2 - x1)

    let tanRatio = verticalHeight / horizontalWidth
    let basicAngle = (Math.atan(tanRatio) * 180) / Math.PI

    if (x2 > x1) {
      if (y2 < y1) {
        arrowHead1.set({ angle: -basicAngle })
      } else if (y2 === y1) {
        arrowHead1.set({ angle: 0 })
      } else if (y2 > y1) {
        arrowHead1.set({ angle: basicAngle })
      }
    } else if (x2 < x1) {
      if (y2 > y1) {
        arrowHead1.set({ angle: 180 - basicAngle })
      } else if (y2 === y1) {
        arrowHead1.set({ angle: 180 })
      } else if (y2 < y1) {
        arrowHead1.set({ angle: 180 + basicAngle })
      }
    }

    canvas.requestRenderAll()
  }
}

function stopDrawingSingleArrowLine() {
  mouseDown = false
  line.setCoords()
  arrowHead1.setCoords()
}

addingLineBtn.addEventListener('click', activateAddingLine)

function activateAddingLine() {
  if (!addingLineBtnCliked) {
    addingLineBtnCliked = true

    canvas.on('mouse:down', startAddingLine)
    canvas.on('mouse:move', startDrawingLine)
    canvas.on('mouse:up', stopDrawingLine)

    canvas.selection = false
    canvas.hoverCursor = 'auto'

    objectSelectability(false)
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
      hasControls: false,
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

  canvas.off({
    'mouse:down': () => {
      startAddingLine()
      startAddingSingleArrowLine()
    },
    'mouse:move': () => {
      startDrawingLine()
      startDrawingSingleArrowLine()
    },
    'mouse:up': () => {
      stopDrawingLine()
      stopDrawingSingleArrowLine()
    },
  })

  objectSelectability(true)

  canvas.hoverCursor = 'all-scroll'
  addingLineBtnCliked = false
}

function objectSelectability(selectable) {
  canvas.getObjects().forEach((o) => {
    o.set({ selectable })
  })
}

canvas.on({
  'object:moved': updateNewLineCoordinates,
  'selection:created': updateNewLineCoordinates,
  'selection:updated': updateNewLineCoordinates,
  'mouse:dblclick': addingControlPoints,
})

let newLineCoords = {}

function updateNewLineCoordinates(o) {
  newLineCoords = {}

  let obj = o.target

  console.log({ obj })

  if (obj.id === 'added-line') {
    let centerX = obj.getCenterPoint().x
    let centerY = obj.getCenterPoint().y

    let x1Offset = obj.calcLinePoints().x1
    let y1Offset = obj.calcLinePoints().y1
    let x2Offset = obj.calcLinePoints().x2
    let y2Offset = obj.calcLinePoints().y2

    newLineCoords = {
      x1: centerX + x1Offset - obj.strokeWidth / 2,
      y1: centerY + y1Offset - obj.strokeWidth / 2,
      x2: centerX + x2Offset - obj.strokeWidth / 2,
      y2: centerY + y2Offset - obj.strokeWidth / 2,
    }

    obj.set(newLineCoords)
    obj.setCoords()
  }
}

function addingControlPoints(o) {
  let obj = o.target

  if (!obj) return

  if (obj.id === 'added-line') {
    obj.set({
      label: 'selected-line',
    })

    let pointer1 = new fabric.Circle({
      id: 'pointer1',
      radius: obj.strokeWidth * 3,
      fill: 'blue',
      opacity: 0.5,
      top: newLineCoords.y1,
      left: newLineCoords.x1,
      originX: 'center',
      originY: 'center',
      hasBorders: false,
      hasControls: false,
    })

    let pointer2 = new fabric.Circle({
      id: 'pointer2',
      radius: obj.strokeWidth * 3,
      fill: 'blue',
      opacity: 0.5,
      top: newLineCoords.y2,
      left: newLineCoords.x2,
      originX: 'center',
      originY: 'center',
      hasBorders: false,
      hasControls: false,
    })

    canvas.add(pointer1, pointer2)
    canvas.setActiveObject(pointer2)
    canvas.requestRenderAll()

    canvas.on({
      'object:moving': endPointOfLineToFollowPointer,
      'selection:cleared': removePointersOnSelectionCleared,
      'selection:updated': removePointersOnSelectionUpdated,
    })
  }
}

function endPointOfLineToFollowPointer(o) {
  let obj = o.target

  if (obj.id === 'pointer1') {
    canvas.getObjects().forEach((o) => {
      if (o.id === 'added-line' && o.label === 'selected-line') {
        o.set({
          x1: obj.left,
          y1: obj.top,
        })

        o.setCoords()
      }
    })
  }

  if (obj.id === 'pointer2') {
    canvas.getObjects().forEach((o) => {
      if (o.id === 'added-line' && o.label === 'selected-line') {
        o.set({
          x2: obj.left,
          y2: obj.top,
        })

        o.setCoords()
      }
    })
  }
}

function removePointersOnSelectionUpdated(o) {
  let obj = o.target

  if (obj.id === 'added-line') {
    removePointersOnSelectionCleared()
  }
}

function removePointersOnSelectionCleared() {
  canvas.getObjects().forEach((o) => {
    if (o.id === 'pointer1' || o.id === 'pointer2') {
      canvas.remove(o)
    }

    if (o.label === 'selected-line') {
      o.set({
        label: '',
      })
    }
  })

  canvas.requestRenderAll()
}
