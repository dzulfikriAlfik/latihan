import { useEffect, useState } from 'react'
import { Link, useParams } from 'react-router-dom'
import { PRODUCTS } from '../data/products'

export default function ProductDetailPage() {
  const [product, setProduct] = useState(null)
  const params = useParams()

  useEffect(() => {
    const product = PRODUCTS.find((product) => product.id === params.productId)

    product ? setProduct(product) : setProduct(null)
  }, [])

  if (!product) return <p>Product is not valid</p>

  return (
    <>
      <h1>Product Detail</h1>
      <p>{product.name}</p>
      <p>
        <Link to='..' relative='path'>
          Back
        </Link>
      </p>
    </>
  )
}
