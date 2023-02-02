import { useParams } from 'react-router-dom'

export default function ProductDetailPage() {
  const params = useParams()

  const validProducts = [
    {
      id: 'product-1',
      name: 'Laptop',
    },
    {
      id: 'product-2',
      name: 'Mouse',
    },
  ]

  const isValidProductId = () => {
    const isValid = validProducts.findIndex(
      (product) => product.id === params.productId
    )

    console.log('isValid : ', isValid)
  }

  return (
    <>
      <h1>Product Detail</h1>
      <p>{params.productId}</p>
    </>
  )
}
