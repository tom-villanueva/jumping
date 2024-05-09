import { useFormStatus } from 'react-dom'
import { Button } from './ui/button'
import { cn } from '@/lib/utils'

const SubmitButton = ({
  label,
  loading,
  icon = null,
  className = '',
  ...rest
}) => {
  const { pending } = useFormStatus()

  return (
    <Button
      disabled={pending}
      type="submit"
      className={cn('', className)}
      {...rest}>
      <div className="flex gap-1">
        {icon}
        {pending ? loading : label}
      </div>
    </Button>
  )
}

export default SubmitButton
