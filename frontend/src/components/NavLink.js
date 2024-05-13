import Link from 'next/link'

const NavLink = ({ active = false, children, ...props }) => (
  <Link
    {...props}
    className={`inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium leading-5 text-redPrimary transition duration-150 ease-in-out focus:outline-none ${
      active
        ? 'border-redPrimary text-redPrimary focus:border-indigo-700'
        : 'border-transparent text-slate-400 hover:border-red-500 hover:text-red-500 focus:border-red-400 focus:text-red-400'
    }`}>
    {children}
  </Link>
)

export default NavLink
