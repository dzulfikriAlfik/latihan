// const canvas = new fabric.Canvas('canvas')

// // Membuat objek 'net'
// const netRect = new fabric.Rect({
//   width: 200,
//   height: 200,
//   fill: 'red',
//   originX: 'center',
//   originY: 'center',
// })

// const netText = new fabric.Text('4 x 4', {
//   fontSize: 20,
//   originX: 'center',
//   originY: 'center',
// })

// const net = new fabric.Group([netRect, netText], {
//   left: 100,
//   top: 100,
// })

// // Membuat objek 'section'
// const sectionPolygon = new fabric.Polygon(
//   [
//     { x: 50, y: 0 },
//     { x: 100, y: 50 },
//     { x: 50, y: 100 },
//     { x: 0, y: 50 },
//   ],
//   {
//     fill: 'blue',
//     originX: 'center',
//     originY: 'center',
//   }
// )

// const sectionText = new fabric.Text('', {
//   fontSize: 20,
//   visible: false,
//   originX: 'center',
//   originY: 'center',
// })

// const section = new fabric.Group([sectionPolygon, sectionText], {
//   left: 300,
//   top: 300,
// })

// canvas.add(net, section)

// // Fungsi untuk memeriksa apakah ada intersection
// function isIntersecting(group1, group2) {
//   const objects1 = group1.getObjects()
//   const objects2 = group2.getObjects()

//   for (let obj1 of objects1) {
//     if (obj1.type === 'rect' || obj1.type === 'polygon') {
//       const points1 = getAbsolutePoints(obj1, group1)

//       for (let obj2 of objects2) {
//         if (obj2.type === 'rect' || obj2.type === 'polygon') {
//           const points2 = getAbsolutePoints(obj2, group2)

//           if (polygonsIntersect(points1, points2)) {
//             return true
//           }
//         }
//       }
//     }
//   }
//   return false
// }

// function getAbsolutePoints(obj, group) {
//   const matrix = obj.calcTransformMatrix()
//   const points = obj.get('points') || [
//     { x: 0, y: 0 },
//     { x: obj.width, y: 0 },
//     { x: obj.width, y: obj.height },
//     { x: 0, y: obj.height },
//   ]
//   return points.map((point) => {
//     return fabric.util.transformPoint(
//       { x: point.x - obj.width / 2, y: point.y - obj.height / 2 },
//       matrix
//     )
//   })
// }

// function polygonsIntersect(points1, points2) {
//   for (let i = 0; i < points1.length; i++) {
//     const nextI = (i + 1) % points1.length
//     const p1 = points1[i]
//     const p2 = points1[nextI]
//     const axisProj = { x: -(p2.y - p1.y), y: p2.x - p1.x }

//     const [minA, maxA] = projectPolygon(axisProj, points1)
//     const [minB, maxB] = projectPolygon(axisProj, points2)

//     if (maxA < minB || maxB < minA) {
//       return false
//     }
//   }

//   for (let i = 0; i < points2.length; i++) {
//     const nextI = (i + 1) % points2.length
//     const p1 = points2[i]
//     const p2 = points2[nextI]
//     const axisProj = { x: -(p2.y - p1.y), y: p2.x - p1.x }

//     const [minA, maxA] = projectPolygon(axisProj, points1)
//     const [minB, maxB] = projectPolygon(axisProj, points2)

//     if (maxA < minB || maxB < minA) {
//       return false
//     }
//   }

//   return true
// }

// function projectPolygon(axis, points) {
//   let min = Infinity
//   let max = -Infinity
//   for (let p of points) {
//     const proj =
//       (p.x * axis.x + p.y * axis.y) / (axis.x * axis.x + axis.y * axis.y)
//     const projPoint = { x: proj * axis.x, y: proj * axis.y }
//     const dotProduct = projPoint.x * axis.x + projPoint.y * axis.y
//     min = Math.min(min, dotProduct)
//     max = Math.max(max, dotProduct)
//   }
//   return [min, max]
// }

// // Event listener untuk object:modified
// canvas.on('object:modified', function (e) {
//   if (isIntersecting(section, net)) {
//     console.log('Intersection detected!')
//   } else {
//     console.log('No intersection.')
//   }
// })

const canvas = new fabric.Canvas('canvas')

// Fungsi untuk membuat objek 'net'
function createNet(left, top) {
  const netRect = new fabric.Rect({
    width: 200,
    height: 200,
    fill: 'red',
    originX: 'center',
    originY: 'center',
  })

  const netText = new fabric.Text('4 x 4', {
    fontSize: 20,
    originX: 'center',
    originY: 'center',
  })

  return new fabric.Group([netRect, netText], {
    left: left,
    top: top,
  })
}

// Fungsi untuk membuat objek 'section'
function createSection(left, top) {
  const sectionPolygon = new fabric.Polygon(
    [
      { x: 50, y: 0 },
      { x: 100, y: 50 },
      { x: 50, y: 100 },
      { x: 0, y: 50 },
    ],
    {
      fill: 'blue',
      originX: 'center',
      originY: 'center',
    }
  )

  const sectionText = new fabric.Text('', {
    fontSize: 20,
    visible: false,
    originX: 'center',
    originY: 'center',
  })

  return new fabric.Group([sectionPolygon, sectionText], {
    left: left,
    top: top,
  })
}

// Membuat beberapa objek 'net'
const nets = [
  createNet(100, 100),
  //   createNet(400, 100),
  //   createNet(100, 400),
  //   createNet(400, 400),
  //   createNet(250, 250),
]

// Membuat beberapa objek 'section'
const sections = [
  createSection(300, 300),
  createSection(500, 100),
  //   createSection(200, 500),
]

canvas.add(...nets, ...sections)

// Fungsi untuk memeriksa apakah ada intersection
function isIntersecting(group1, group2) {
  const objects1 = group1.getObjects()
  const objects2 = group2.getObjects()

  for (let obj1 of objects1) {
    if (obj1.type === 'rect' || obj1.type === 'polygon') {
      const points1 = getAbsolutePoints(obj1, group1)

      for (let obj2 of objects2) {
        if (obj2.type === 'rect' || obj2.type === 'polygon') {
          const points2 = getAbsolutePoints(obj2, group2)

          if (polygonsIntersect(points1, points2)) {
            return true
          }
        }
      }
    }
  }
  return false
}

function getAbsolutePoints(obj, group) {
  const matrix = obj.calcTransformMatrix()
  const points = obj.get('points') || [
    { x: 0, y: 0 },
    { x: obj.width, y: 0 },
    { x: obj.width, y: obj.height },
    { x: 0, y: obj.height },
  ]

  console.log('console getAbsolutePoints', { points, obj, group })

  return points.map((point) => {
    return fabric.util.transformPoint(
      { x: point.x - obj.width / 2, y: point.y - obj.height / 2 },
      matrix
    )
  })
}

function polygonsIntersect(points1, points2) {
  for (let i = 0; i < points1.length; i++) {
    const nextI = (i + 1) % points1.length
    const p1 = points1[i]
    const p2 = points1[nextI]
    const axisProj = { x: -(p2.y - p1.y), y: p2.x - p1.x }

    const [minA, maxA] = projectPolygon(axisProj, points1)
    const [minB, maxB] = projectPolygon(axisProj, points2)

    if (maxA < minB || maxB < minA) {
      return false
    }
  }

  for (let i = 0; i < points2.length; i++) {
    const nextI = (i + 1) % points2.length
    const p1 = points2[i]
    const p2 = points2[nextI]
    const axisProj = { x: -(p2.y - p1.y), y: p2.x - p1.x }

    const [minA, maxA] = projectPolygon(axisProj, points1)
    const [minB, maxB] = projectPolygon(axisProj, points2)

    if (maxA < minB || maxB < minA) {
      return false
    }
  }

  return true
}

function projectPolygon(axis, points) {
  let min = Infinity
  let max = -Infinity
  for (let p of points) {
    const proj =
      (p.x * axis.x + p.y * axis.y) / (axis.x * axis.x + axis.y * axis.y)
    const projPoint = { x: proj * axis.x, y: proj * axis.y }
    const dotProduct = projPoint.x * axis.x + projPoint.y * axis.y
    min = Math.min(min, dotProduct)
    max = Math.max(max, dotProduct)
  }
  return [min, max]
}

// Event listener untuk object:modified
canvas.on('object:modified', function (e) {
  let netIntersections = new Map()

  for (let section of sections) {
    for (let net of nets) {
      if (isIntersecting(section, net)) {
        if (netIntersections.has(net)) {
          netIntersections.get(net).push(section)
        } else {
          netIntersections.set(net, [section])
        }
      }
    }
  }

  let hasError = false

  // Periksa apakah ada lebih dari satu intersection per net
  netIntersections.forEach((sections, net) => {
    if (sections.length > 1) {
      console.warn('Error: A single net intersects with more than one section.')
      hasError = true
    }
  })

  // Periksa apakah ada net yang tidak beririsan dengan section
  if (netIntersections.size < nets.length) {
    console.warn('Error: At least one net does not intersect with any section.')
    hasError = true
  }

  if (!hasError) {
    console.info('All intersections are valid.')
  }
})
