/* eslint-disable react/prop-types */
function Header({ author }) {
  return <h1>Hello, {author || 'WPU'} 🚀</h1>
}

export default Header
