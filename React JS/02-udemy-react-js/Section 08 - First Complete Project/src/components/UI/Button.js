import styles from './Button.module.css'

export default function Button({ children, className, type, onClick }) {
  return (
    <button
      className={`${styles.button} ${className}`}
      type={type || 'button'}
      onClick={onClick}>
      {children}
    </button>
  )
}
