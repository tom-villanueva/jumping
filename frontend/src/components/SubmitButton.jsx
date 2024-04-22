import { useFormStatus } from 'react-dom'
import { Button } from './ui/button'
import { cn } from '@/lib/utils'

const SubmitButton = ({ label, loading, className = '' }) => {
  const { pending } = useFormStatus()

  return (
    <Button disabled={pending} type="submit" className={cn('', className)}>
      {pending ? loading : label}
    </Button>
  )
}

export default SubmitButton
