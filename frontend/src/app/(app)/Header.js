const Header = ({ title }) => {
  return (
    <header className="bg-slate-600 shadow">
      <div className="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h2 className="text-xl font-semibold leading-tight text-gray-800">
          {title}
        </h2>
      </div>
    </header>
  )
}

export default Header
