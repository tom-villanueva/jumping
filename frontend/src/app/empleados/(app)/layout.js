import App from './App'

const AppLayout = ({ children, header }) => {
  return (
    <div className="min-h-screen bg-slate-900 pb-10">
      <App>{children}</App>
    </div>
  )
}

export default AppLayout
