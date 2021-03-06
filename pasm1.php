<?php

//namespace Adoms\src\pasm;

class PASM 
{

    public $ZF = 0;    // Comparison Flag for Exchanges
    public $OF = 0;    // Overflow Flag
    public $CF = 0;    // Carry Flag
    public $counter = 0;   // Needed for loops
    public $chain = array();   // Chain of events in line use $this->end() to stop and start again
    public $args = array();    // Array to hold args for set variables
    public $stack = array();    // Stack
    public $array = array();    // array for stack formations
    public $sp;         // Stack pointer
    public $ST0;        // LAST STACK ELEMENT
    public $pdb = 1;    // debug flag (DEFAULT FALSE)
    // The stack is referenced under objects
    // The pairing, is to be justified, with
    // a simulacrum between the object and the
    // variable. Inside and out. This is an image.
    // You may make apps out of it. You may make
    // such PHP wrappers as to create formidable
    // language enhancements and have a fast,
    // easy to see connection to low level speed
    public $tp;     // holder for current bit
    public $ecx;    // RHS, DECR, INC, COMPARATOR
    public $adx;    // Registers
    public $bdx;    //
    public $cdx;    //
    public $ddx;    //
    public $edx;    //
    public $ah;     // LHS, COMPARATOR
    public $ldp;    // The amount of commands to go back in loops and jmps
    public $rdx;    // Holds answers to addition, and other math
    public $qword;  // String Register
    public $RC;     // Round to this decimal
    public $wait;   // wait variable
    public $strp;   // string pointer
    public $cl;    // BOOL ANSWER FOR JMP
    public $string; // STRING register
    public $lop;   // Place in $chain
    public $err;    // Error No.
    public $err_str;    // Error String

    public function get () {    // Useful for some testing
                   
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];// Will be easier to just play around
                                // However this verifies all methods work
        foreach (get_class_methods($this) as $method) 
        {
            if ($method == "get")
                continue;
            $r = new \ReflectionMethod("PASM", $method);
            $params = $r->getParameters();
            $results = [];
            $p = [];
            foreach ($params as $param) {
                //$param is an instance of ReflectionParameter
                $p[] = $param->getName();
                $results = $p;
                
                //echo $param->isOptional();
            }
            
            $x = new PASM();
            $y = "$" . implode(',$',$results);
            try {
                $this->ecx = 3;
                $this->ah = 3;
                $this->$method();
                continue;
            }
            catch (\Exception $e) {
                $this->ecx = 2;
                $this->ah = 3;
                $this->$method();
                continue;
            }
            finally {
                $this->ecx = [2];
                $this->ah = [3];
                $this->$method();
            }
        }
    }

    public function varp(string $var = "ah") {
        $method_del = explode("::", __METHOD__);

         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        echo $this->$var;
        return new static;
    }
    // All functions are 100% ASM derived
    // Together there are 225+ functions
    // Do to obvious nature of names and
    // functionality they will have a small
    // amount of documentation.
    public function char_adjust_addition()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $this->rdx = chr(($this->ecx + $this->ah)%256);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static; 

    }

    public function carry_add()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->cl = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function add()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = $this->ecx + $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function and()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->cl = $this->ecx & $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function chmod()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        chmod($this->string, $this->ah);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function bit_scan_fwd()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->tp == null) {
            $this->tp = $this->qword;   // qword is used to look through a string via bit scanning
            $this->tp = decbin($this->tp);
            $this->tp = str_split($this->tp,1);
            reset($this->tp);
            return new static;
        }
        next($this->tp);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function bit_scan_rvr()                  // reverse of above
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->tp == null) {
            $this->tp = $this->qword;
            $this->tp = decbin($this->tp);
            $this->tp = str_split($this->tp,1);
            end($this->tp);
            return new static;
        }
        prev($this->tp);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function byte_rvr()                  // reverse byte
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $temp = decbin($this->ecx);
        $this->rdx = strrev($temp);
        $this->rdx = bindec($this->rdx);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function bit_test()                  // bit is filled in pointer
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        return $this->tp[$this->ah];
    }

    public function bit_test_comp()         // look thru byte and see the $ah'th bit
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $bo = decbin($this->ecx);
        $bo = $bo[$this->ah];
        $this->CF = (bool)($bo);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function bit_test_reset()    // Clear bit test flag
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $bo = decbin($this->ecx);
        $bo = $bo[$this->ah];
        $this->CF = (bool)($bo);
        $this->ecx = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function bit_test_set()                  // Test bit
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $bo = decbin($this->ecx);
        $bo = $bo[$this->ah];
        $this->CF = (bool)($bo);
        $this->ecx[$this->ah] = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function call()                  // call any function
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (is_callable($this->ST0))
            return call_user_func($this->ST0(), $this->string, $this->ah);
    }

    public function cmp_mov_a()         // heck ah against top of stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->ah > $this->ST0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_ae()    // same (documenting will continue below)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->ah >= $this->ST0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_b()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->ah < $this->ST0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_be()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->ah <= $this->ST0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_e()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->ah == $this->ST0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_nz()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->CF == 1 & $this->ah == $this->ST0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_pe()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->CF == 0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_po()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->CF == 1) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_s()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->ah < 0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_mov_z()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = ($this->ah > 0) ? $this->ah : $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function mov()   // move ah to ecx. Same as mov_ah()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function movabs()    // copy $ecx to stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->stack, array("movabs" => $this->ecx));
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function clear_carry()   // clear $CF
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->CF = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function clear_registers()   // make all registers 0
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->CF = $this->adx = $this->bdx = $this->cdx = $this->ddx = $this->edx = $this->rdx = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function comp_carry()    // negate $CF
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->CF = !($this->CF);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_e()         // bool of equality comparison (documentation continues below)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->cl = $this->ecx == $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_same()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->cl = $this->ecx == $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cmp_xchg()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ecx == $this->ah) {
            $this->rdx = $this->ah;
            $this->ZF = 1;
            return new static;
        }
        else {
            $this->rdx = $this->ah;
            $this->ZF = 0;
            return new static;
        }
    }

    public function decr()                  // decrement ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx--;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function divide()    // $ecx/$ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (is_numeric($this->ecx) && is_numeric($this->ah))
        $this->rdx = round($this->ecx/$this->ah);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function absf()                  // absolute value of $ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = abs($this->ah);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function addf()                  // add $ecx and $ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = $this->ecx + $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function round()         // round top stack to RC decimal
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $this->ST0 = &$this->stack[array_key_last($this->stack)];
        $this->ST0 = round($this->ST0, $this->RC);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function round_pop()         // same but pop
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $this->ah = &$this->stack[array_key_last($this->stack)];
        $this->ah = round($this->ST0, $this->RC);
        array_pop($this->stack);
        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function neg()   // negate $ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (is_numeric($this->ah))
            $this->rdx = $this->ah * (-1);
            if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function stack_cmov_b()                  // move on comparison (begins again below)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->ST0 != null && $this->ah < $this->ST0)
            $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function stack_cmov_be()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->ST0 != null && $this->ah <= $this->ST0)
            $this->rdx = $this->ah;
            return new static;
    }

    public function stack_cmov_e()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->ST0 != null && $this->ah == $this->ST0)
            $this->rdx = $this->ah;
            return new static;
    }

    public function stack_cmov_nb()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->ST0 != null && $this->ah > $this->ST0)
            $this->rdx = $this->ah;
            return new static;
    }

    public function stack_cmov_nbe()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->ST0 != null && $this->ah >= $this->ST0)
            $this->rdx = $this->ah;
            return new static;
    }

    public function stack_cmov_ne()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->ST0 != null && $this->ah != $this->ST0)
            $this->rdx = $this->ah;
            return new static;
    }

    public function fcomp()         // subtract top of stack from $ah and pop
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
  
        if (!is_numeric($this->ah) || !$this->stack[array_key_last($this->stack)])
            return new static;
        $this->rdx = $this->ah - $this->stack[array_key_last($this->stack)];
        array_pop($this->stack);
        if (count($this->stack) > 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            $this->ST0 = null;
        if ($this->ST0 != null && $this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function cosine()    // change top of stack to cosine of top of stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ST0 = &$this->stack[array_key_last($this->stack)];
        $this->ST0 = ($this->ST0 != null) ? cos($this->ST0) : null;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function stack_pnt_rev()         // go reverse the stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        prev($this->stack);
        $this->sp = current($this->stack);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fdiv()                  // divide ST0 into $ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ah == 0) {
            echo "Denominator cannot be 0";
            $this->cl = 0;
            return new static;
        }
        else if (!is_numeric($this->ecx) || !$this->stack[array_key_last($this->stack)])
            return new static;
        $this->rdx = $this->ecx / $this->ST0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fdiv_pop()                  // opposite as above and pop
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ST0 == 0) {
            echo "Denominator cannot be 0";
            $this->cl = 0;
            return new static;
        }
        $this->rdx = $this->ST0 / $this->ecx;
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fdiv_rev()                  // opposite of fdiv
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ST0 == 0) {
            echo "Denominator cannot be 0";
            $this->cl = 0;
            return new static;
        }
        $this->rdx = $this->ST0 / $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fdiv_rev_pop()                  // same as above with po
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ST0 == 0) {
            echo "Denominator cannot be 0";
            $this->cl = 0;
            return new static;
        }
        $this->rdx = $this->ecx / $this->ST0;
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function add_stack()         // add top of stack to ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !$this->stack[array_key_last($this->stack)])
            return new static;
        $this->rdx = $this->ecx + $this->ST0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function ficomp()    // compare and pop
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ST0 == $this->ah)
            $this->cl = 1;
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function recvr_stack(string $filename) {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!file_exists($filename))
            return false;
        $this->stack = (unserialize(file_get_contents($filename)));
        //$this->addr() 
          //  ->movr()
            //->end();
        return new static;
    }

    public function stack_load() // stack with count on stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $key = "f" . count($this->stack);
        array_push($this->stack, array($key => $this->ecx));
        $this->ecx = null;
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }
    
    public function stack_mrg() // stack with count on stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $key = "f" . count($this->stack);
        array_merge($this->stack, $this->array);
        $this->ecx = null;
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }
    
    public function fmul()                  // multiplies ecx and ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !$this->stack[array_key_last($this->stack)])
            return new static;
        $this->rdx = $this->ecx * $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function stack_pnt_fwd()         // moves stack pointer forward
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        next($this->stack);
        $this->sp = current($this->stack);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function store_int()         // subtracts $ST0 - 2-to-the-$ah and puts answer in $rdx 
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (ctype_xdigit($this->stack[array_key_last($this->stack)]))
            $this->ST0 = hexdec($this->stack[array_key_last($this->stack)]);
        if (is_numeric($this->stack[array_key_last($this->stack)]))
            $this->ST0 = decbin($this->stack[array_key_last($this->stack)]);
        $test = rtrim($this->ST0,"01");
        if (strlen($test) == 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            return;
        if (is_numeric($this->ah))
            $this->rdx = $this->ST0 - pow(2,8*$this->ah);
        else {
            echo "\$ah is not in numeric form";
            return;
        }
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function store_int_pop() // same as above, but with pop
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !is_numeric($this->stack[array_key_last($this->stack)])) {
            echo "Invalid Operand in store_int_pop: \$ah = $this->ah & $this->ST0 = " . $this->stack[array_key_last($this->stack)];
            return;
        }
        if (ctype_xdigit($this->stack[array_key_last($this->stack)]))
            $this->ST0 = hexdec($this->stack[array_key_last($this->stack)]);
        if (is_numeric($this->stack[array_key_last($this->stack)]))
            $this->ST0 = decbin($this->stack[array_key_last($this->stack)]);
        $test = rtrim($this->ST0,"01");
        if (strlen($test) == 0)
            $this->ST0 = $this->stack[array_key_last($this->stack)];
        else
            return;
        if (is_numeric($this->ah))
            $this->rdx = $this->ST0 - pow(2,8*$this->ah);
        else {
            echo "\$ah is not in numeric form";
            return;
        }
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract_rev() // like subtract but backwards
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !is_numeric($this->ecx) || !$this->stack[array_key_last($this->stack)])
            return;
        $this->rdx = $this->ecx - $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract()  // $ah - $ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !is_numeric($this->ecx) || !$this->stack[array_key_last($this->stack)])
            return;
        $this->rdx = $this->ah - $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fld1()  // pushes ecx+1 to stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx))
            return;
        array_push($this->stack, array("inc" => ($this->ecx + 1)));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_logl2() //
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->stack, array("logl2" => log(log(2))));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_logl2t()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->stack, array("logl2t" => log(2,10)));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_loglg2()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah))
        {
            echo "\$ah must be numeric for load_loglg2";
            return;
        }
        array_push($this->stack, array("loglg2" => log(2,log($this->ah))));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_ln2()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $e = M_E;
        array_push($this->stack, array("ln2" => log($e,2)));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_pi()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->stack, array("pi" => M_PI));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function float_test()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah))
        {
            echo "\$ah must be numeric for float_test";
            return;
        }
        $this->rdx = $this->ah + 0.0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fmul_pop() // ah * ecx and pop
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !$this->stack[array_key_last($this->stack)])
            return;
        $this->rdx = $this->ah * $this->ecx;
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function clean_exceptions()  // clear exception bit
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ZF = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function clean_reg() // clear cl
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->cl = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fnop()  // counts as function, does nothing but takes up space (like in assembly)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fpatan()    // gets arctan of $ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }


        $this->cl = atan($this->ah);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fptan() // gets tangent of ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->cl = tan($this->ah);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fprem() // look to documentation (Oracle Systems Manual)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->stack[count($this->stack)-2]) || !is_numeric($this->stack[array_key_last($this->stack)]))
            return new static;
        if (count($this->stack) > 1)
            $this->ecx = $this->stack[array_key_last($this->stack)] / $this->stack[count($this->stack)-2];
        $this->rdx = (round($this->ecx,($this->RC+1)) - ($this->ecx*10*($this->RC+1)))/10/(1+$this->RC);
        $this->cl = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function frndint()   // round top of stack into $rdx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx) || !$this->stack[array_key_last($this->stack)])
            return new static;
        $this->rdx = round($this->stack[array_key_last($this->stack)], $this->RC);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function frstor() // copy $ah to $rdx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fsin() // change top of stack to sin of top of stack
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $this->ST0 = &$this->stack[array_key_last($this->stack)];
        $this->ST0 = ($this->ST0 != null) ? sin($this->ST0) : null;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fsincos() // push cos of $ST0 to stack and fill $ST0 with sin of itself
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        array_push($this->stack, array("cos" => cos($this->ST0)));
        $this->ST0 = ($this->ST0 != null) ? sin($this->ST0) : null;
        next($this->stack);
        $this->ST0 = current($this->stack);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fscale()    // round top 2 stack elements and push to rdx ans powers of 2
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $sp1 = round($this->stack[count($this->stack)-2]);
        $sp0 = $this->stack[array_key_last($this->stack)];
        if (!is_numeric($sp1) || !is_numeric($sp0))
        {
            echo "Top 2 stack registers must be numeric for fscale()";
            return;
        }
        $this->rdx = pow(2,$sp0+$sp1);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fsqrt() // push to stack top value's sqrt
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->stack[array_key_last($this->stack)] = sqrt($this->stack[array_key_last($this->stack)]);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fst() // copy ST0 to another position ($ecx)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ST0 = $this->stack[array_key_last($this->stack)];
        $this->stack[$this->ecx] = $this->ST0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fstcw() // push $ah to $rdx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fstp()  // same as fst() but pops
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->stack[$this->ecx] = $this->stack[array_key_last($this->stack)];
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract_pop()  // like it says ($ah - $ST0)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if (!is_numeric($this->ah) || !is_numeric($this->stack[array_key_last($this->stack)]))
        {
            echo "\$ST0 & \$ah must be numeric for subtract_pop";
            return;
        }
        $this->rdx = $this->ah - ($this->ST0);
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract_rev_pop() // (same only reverse)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !is_numeric($this->stack[array_key_last($this->stack)]))
        {
            echo "\$ST0 & \$ah must be numeric for subtract_rev_pop";
            return;
        }
        $this->rdx = $this->ST0 - $this->ah;
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function ftst()  // check that math works
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->rdx))
        {
            echo "\$rdx must be numeric for ftst";
            return;
        }
        $this->rdx -= 0.0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fucom() // ecx == $sp and $rdx = $ST0
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx) || !$this->stack[array_key_last($this->stack)])
            return new static;
        if (!is_float($this->stack[$this->ecx]) || !is_float($this->ST0))
            $this->CF = 7;
        $this->ecx = $this->sp;
        $this->rdx = $this->ST0;
        if (0 != ($this->ecx - $this->ah))  // Now derive carry flag
            $this->CF = ($this->ecx < $this->ah) ? 0 : 1;
        else
            $this->CF = 4;
            if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fucomp()    // above ith pop
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->fucom();
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fucompp()   // above with another pop
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->fucom();
        array_pop($this->stack);
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fxam()  // get decimal value, without integer
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !$this->stack[array_key_last($this->stack)])
            return new static;
        $this->rdx = $this->ah - round($this->ah);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fxch()  // exchange values from one stack place to another (the top)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ST0 = &$this->stack[array_key_last($this->stack)];
        $temp = $this->stack[$this->ecx];
        $this->stack[$this->ecx] = $this->ST0;  // goes into $this->ecx
        $this->ST0 = $temp;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fxtract()   // get highest significand and exponent of number
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ah) || !is_numeric($this->stack[array_key_last($this->stack)]))
        {
            echo "\$ST0 & \$ah must be numeric for fxtract";
            return;
        }
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        $ot = $this->ST0;
        $t = 1;
        $this->ah = $this->ST0;
        $significand = 0;
        $exponent = 0;
        $worked = "";
        while (0 < $ot) {
            $t = $this->ah;
            while ($t > 0) {
                $exponent = $t;
                $significand = $ot;
                if ($this->ah == pow($significand,$exponent)) {
                    $temp_sig = $significand;
                    $temp_exp = $exponent;
                }
                $t -= 1;
            }
            $ot -= 1;
        }
        $this->ST0 = $exponent;
        $this->stack[array_key_last($this->stack)] = $significand;
        array_push($this->stack, array("exp" => $exponent));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fyl2x()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx) || !is_numeric($this->ah))
            return new static;
        $this->rdx = $this->ecx * log($this->ah,2);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function fyl2xp1()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx) || !is_numeric($this->ah))
            return new static;
        $this->rdx = $this->ecx * log($this->ah,2 + 1);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function hlt(string $async_filename, string $signal = null) {

        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        // Push the "signal" variable into the $async_filename(.json)
        // If it is anything but the "signal", it will stay halted
        // Use SESSID or cURL to change the file. (Remote Hosted)
        // Being Deprecated
        go_again:
            usleep(2500);
            try {
                $async = file_get_contents($async_filename);
                $async = json_decode($async);
            }
            catch (\Exception $e)
            {}
            if ($async->signal != $signal)
                goto go_again;
                if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function idiv()  // divide $ah / $ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx) || !is_numeric($this->ah))
            return new static;
        $this->rdx = $this->ah / $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function imul()  // $ah * $ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx) || !is_numeric($this->ah))
            return new static;
        $this->rdx = $this->ah * $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function in()    // $string is server, collects in $buffer
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $socket = stream_socket_server($this->string, $err, $err_str);
        if (!$socket) {
            echo "$this->err ($this->err_str)<br />\n";
            $this->cl = 0;
            return new static;
        }
        else {
            while ($conn = stream_socket_accept($socket)) {
              $this->add_to_buffer(fread($conn, 1000));
              fclose($conn);
            }
            fclose($socket);
        }
        $this->cl = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function inc()   // increment $ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_numeric($this->ecx))
            return new static;
        $this->ecx++;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function in_b()  // read 1 byte at a time
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_string($this->string) || 0 == count($this->string))
        {
            echo "\$string must be numeric for in_b";
            return;
        }
        $socket = stream_socket_server($this->string, $err, $err_str);
        if (!$socket) {
            echo "$this->err ($this->err_str)<br />\n";
            $this->cl = 0;
            return new static;
        }
        else {
            while ($conn = stream_socket_accept($socket)) {
                $this->add_to_buffer( fread($conn, 1) );
              fclose($conn);
            }
            fclose($socket);
        }
        $this->cl = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function in_d() // read 1 dword at a time
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_string($this->string) || 0 == count($this->string))
        {
            echo "\$string must be numeric for in_d";
            return;
        }
        $socket = stream_socket_server($this->string, $err, $err_str);
        if (!$socket) {
            echo "$this->err ($this->err_str)<br />\n";
            $this->cl = 0;
            return new static;
        }
        else {
            while ($conn = stream_socket_accept($socket)) {
                $this->add_to_buffer( fread($conn, 4) );
              fclose($conn);
            }
            fclose($socket);
        }
        $this->cl = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function in_w()  // read word at a time
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_string($this->string) || 0 == count($this->string))
        {
            echo "\$string must be numeric for " . __METHOD__;
            return;
        }
        $socket = stream_socket_server($this->string, $this->err, $this->err_str);
        if (!$socket) {
            echo "$this->err_str ($this->err)<br />\n";
            $this->cl = 0;
            return new static;
        }
        else {
            while ($conn = stream_socket_accept($socket)) {
                $this->add_to_buffer( fread($conn, 2) );
              fclose($conn);
            }
            fclose($socket);
        }
        $this->cl = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function in_q()  // read quad word at a time
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_string($this->string) || 0 == strlen($this->string))
        {
            echo "\$string must be numeric for " . __METHOD__;
            return;
        }
        $socket = stream_socket_server($this->string, $this->err, $this->err_str);
        if (!$socket) {
            echo "$this->err_str ($this->err)<br />\n";
            $this->cl = 0;
            return;
        }
        else {
            while ($conn = stream_socket_accept($socket)) {
                $this->add_to_buffer( fread($conn, 8) );
                fclose($conn);
            }
            fclose($socket);
        }
        $this->cl = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function interrupt($async_filename)  // push $ecx into $file->signal for interrupts and async calls
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_string($async_filename) || !is_numeric($this->ah))
            return new static;
        $async = file_get_contents($async_filename);
        $async = json_encode($async);
        $async->signal = $this->ecx;
        file_put_contents($async_filename,json_decode($async));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function write() // write to file $string from $buffer
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!is_string($this->buffer) && !is_numeric($this->buffer))
            return;
    
        file_put_contents($this->string, $this->buffer);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function read()     // read from file $this->string
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if (!file_exists($this->string)) {
            echo "Missing file: $this->string";
            return;
        }
    
        $this->buffer = file_get_contents($this->string);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function mov_buffer()    // (really) move $buffer to stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->stack, $this->buffer);
        $this->buffer = "";
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function ja()    // from here down to next letter, is jmp commands (obvious to anyone)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah > $this->ecx) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }   
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jae()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah >= $this->ecx) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jb()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah < $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jbe()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->chain != null && $this->chain[$this->lop] == '' && $this->jbl == 1)
            $this->ecxl = 0;
        else
            return false;
        echo $this->chain[$this->lop]['function'];
        
        if ($this->ah <= $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
        }
        $this->coast();
        if ($this->pdb == 1)
            echo $this->lop . " " ;
        $this->lop++;
        return new static;
    }

    public function jc()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx == 1 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jcxz()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah == $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function je()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah == $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jg()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah > $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jge()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah >= $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jl()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah < $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jle()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah < $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jmp()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        
        
            $this->lop -= $this->ldp;
        $this->args[] = func_get_args();

        if ($this->ecx != null && $this->ecx != null && $this->lop < count($this->chain)) {
            $func = $this->chain[$this->lop%count($this->chain)+1];
            if ($func == 'set')
                $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
            else
                $this->$func();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jnae()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah < $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jnb()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah >= $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jnbe()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah > $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                if (count($this->chain) <= $this->lop%count($this->chain))
                    $func = $this->chain[$this->lop%count($this->chain)];
                else
                    $func = $this->chain[$this->lop%count($this->chain)+1];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jnc()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx == 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jne()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        print_r($this->chain);
        if ($this->ah != $this->ecx && $this->ah != null) {
            //$this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {
                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop%count($this->args)][0],$this->args[$this->lop%count($this->args)][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jng()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ah < $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jnl()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx > $this->ecx && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jno()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx == 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jns()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx >= 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jnz()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx != 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jgz()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx > 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jlz()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx < 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jzge()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx >= 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jzle()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx <= 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jo()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx == 1 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jpe()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx%2 == 0 && $this->ah%2 && $this->ecx%2 == 0) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jpo()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx%2 == 1 && $this->ah%2 == 1 && $this->ecx%2 == 1) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function jz()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        
        if ($this->ecx == 0 && $this->ah != null) {
            $this->lop -= $this->ldp;
            if ($this->ah != null && $this->ecx != null) {

                $func = $this->chain[$this->lop%count($this->chain)];
                if ($func == 'set')
                    $this->$func($this->args[$this->lop][0],$this->args[$this->lop][1]);
                else
                    $this->$func();
            }
            $this->jbl = 1;
            $this->coast();
        }
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_all_flags()    // load all flags to $ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ah = ($this->OF) + ($this->CF * 2) + ($this->ZF * 4);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function end() {     // reset all command chains
        $this->chain = [];
        $this->args = array();
        $this->lop = 0;
        $this->counter = 0;
    }

    public function leave() // exit program
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        exit();
    }

    public function mov_ecx()   // move ecx to ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $this->ah = $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function mov_ah()    // move ah to ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $this->ecx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_str($str = "")  // mov ecx to $string
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $this->string = empty($str) ? $this->ecx : $str;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function coast()     // the secret sauce. Go thru rest of commands after $ldp drop
    {
        $counted = 0;
        $count = count($this->chain);
        while ($this->lop + $counted < $count && $this->lop + $counted > 0) {
            $func = $this->chain[$this->lop + $counted];
            if ($func == 'set')
                $this->$func($this->args[$this->counter+$counted][0],$this->args[$this->counter+$counted][1]);
            else
                $this->$func();
            $counted++;
        }
        $this->ldp = 0;
        $this->counter = 0;
    }

    /*
     * This function requires that $this->ecx
     * be filled with a value > counter. Otherwise
     * it will not work out.
    */
    public function loop()      // loop til $counter == $ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
         
        $count = count($this->chain);
            $this->lop -= $this->ldp;
        if ($this->counter < $this->ecx && $this->lop + $this->counter < $count) {
            $func = $this->chain[$this->lop + $this->counter];
            if ($func == 'set')
                $this->$func($this->args[$this->lop + $this->counter][0],$this->args[$this->lop + $this->counter][1]);
            else
                $this->$func();
            $this->counter++;
            
            if ($this->pdb == 1)
                echo $this->lop . " ";
        }
        $this->coast();
        $this->counter = 0;
        return new static;
    }

    /*
     * This function requires that $this->ecx
     * be filled with a value == $this->ah. Otherwise
     * it will not work out. Change $this->ecx
     * in the previous function
    */
    public function loope()     // loop while ah == ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $counter = 0;
        
        $count = count($this->chain);
            $this->lop -= $this->ldp;
        if ($this->ah == $this->ecx && $this->lop < $count) {
            $func = $this->chain[$this->lop + $this->counter];
            if ($func == 'set')
                $this->$func($this->args[$this->lop + $this->counter][0],$this->args[$this->lop + $this->counter][1]);
            else
                $this->$func();
            $this->counter++;
            if ($this->pdb == 1)
                echo $this->lop . " ";
        }
        
        $this->coast();
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function loopne()    // loop while ah and ecx are not equal
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $counter = 0;
        if (!is_numeric($this->ah) || !is_numeric($this->ah))
            return new static;
            
        
        $count = count($this->chain);
            $this->lop -= $this->ldp;
        if ($this->ah != $this->ecx && $this->lop < $count) {
            $func = $this->chain[$this->lop + $this->counter];
            if ($func == 'set')
                $this->$func($this->args[$this->lop + $this->counter][0],$this->args[$this->lop + $this->counter][1]);
            else
                $this->$func();
            $this->counter++;
            if ($this->pdb == 1)
            $this->coast();
            echo $this->lop . " ";
            return new static;
        }
        
        $this->coast();
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function loopnz()    // loop while ecx is not 0
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $counter = 0;
        if (!is_numeric($this->ah) || !is_numeric($this->ah))
            return new static;
            
        
        $count = count($this->chain);
            $this->lop -= $this->ldp;
        if (0 != $this->ecx && $this->lop < $count) {
            $func = $this->chain[$this->lop + $this->counter];
            if ($func == 'set')
                $this->$func($this->args[$this->lop + $this->counter][0],$this->args[$this->lop + $this->counter][1]);
            else
                $this->$func();
            $this->counter++;
            if ($this->pdb == 1)
                echo $this->lop . " ";
            $this->coast();

            return new static;
        }
        $this->coast();
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function loopz()     // loop while ecx == 0
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $counter = 0;
        if (!is_numeric($this->ah) || !is_numeric($this->ah))
            return new static;
        
        $count = count($this->chain);
            $this->lop -= $this->ldp;
        if (0 == $this->ecx && $this->lop < $count) {
            $func = $this->chain[$this->lop + $this->counter];
            if ($func == 'set')
                $this->$func($this->args[$this->lop + $this->counter][0],$this->args[$this->lop + $this->counter][1]);
            else
                $this->$func();
            $this->counter++;
            $this->coast();
        }
        $this->coast();
        
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function mul()   // another ah * ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx *= $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function movs()  // move $string to stack and clear
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->stack, $this->string);
        $this->string = "";
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function reset_sp() {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        end($this->stack);
        $this->sp = current($this->stack);
        return new static;
    }

    public function movr()  // move $string to stack and clear
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        foreach ($this->array as $kv)
            $this->stack[count($this->stack)] = ($kv);
        $this->array = [];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function addr(array $ar)  // move $string to stack and clear
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->array, $ar);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function mwait()   // wait $wait microseconds
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        usleep($this->wait);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function nop() {}    //

    public function not()   // performs a not on $ah ad ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ecx != $this->ah)
            $this->cl = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function or()    // performs a or on ecx and ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ecx or $this->ah)
            $this->cl = 1;
            if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function out()   // moves buffer to site $string
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $socket = stream_socket_server($this->string, $err, $err_str);
        if (!$socket) {
            echo "$this->err ($this->err_str)<br />\n";
        }
        else {
            while ($conn = stream_socket_accept($socket)) {
              fwrite($conn, $this->buffer, strlen($this->buffer));
              fclose($conn);
            }
            fclose($socket);
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function obj_push(string $object, array $args) // push object to stack
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $x = new \ReflectionClass($object);
        $x->newInstanceArgs($args);
        array_push($this->stack, array("obj" => $x));
    }

    public function pop()   // pop stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function push()  // push ecx to stack
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        array_push($this->stack, $this->ecx);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function shift_left()    // shift ah left ecx times
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ah = decbin($this->ah);
        if (strlen($this->ah) == 1) {
            $this->OF = 1;
            return new static;
        }
        while ($this->ecx-- > 0)
        {
            $this->ah = rtrim($this->ah,"0");
            $t = &$this->ah[strlen($this->ah)-1];
            array_unshift($this->ah,$t);
            $this->CF = $this->CF ^ $t;
        }
        $this->ah = bindec($this->ah);
        $t = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function shift_right()   // shift ah right ecx times
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ah = decbin($this->ah);
        if (strlen($this->ah) == 1) {
            $this->OF = 1;
            return new static;
        }
        while ($this->ecx-- > 0)
        {
            $this->ah = rtrim($this->ah,"0");
            $t = &$this->ah[strlen($this->ah)-1];
            $s = &$this->ah[strlen($this->ah)-2];
            array_push($this->ah,$t);
            array_shift($this->ah);
            array_unshift($this->ah,$t);
            $this->CF = $this->CF ^ $t ^ $s;
        }
        $this->ah = bindec($this->ah);
        $t = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function mv_shift_left() // pull bit around ecx times on ah (left)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ah = decbin($this->ah);
        if (strlen($this->ah) == 1) {
            $this->OF = 1;
            return new static;
        }
        while ($this->ecx-- > 0)
        {
            $this->ah = rtrim($this->ah,"0");
            $t = &$this->ah[strlen($this->ah)-1];
            array_push($this->ah,$t);
            array_unshift($this->ah,$t);
            $this->CF = $this->CF ^ $t;
        }
        $this->ah = bindec($this->ah);
        $t = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function mv_shift_right()    // same as above but (right)
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ah = decbin($this->ah);
        if (strlen($this->ah) == 1) {
            $this->OF = 1;
            return new static;
        }
        while ($this->ecx-- > 0)
        {
            $this->ah = rtrim($this->ah,"0");
            $t = &$this->ah[strlen($this->ah)-1];
            $s = &$this->ah[strlen($this->ah)-2];
            array_push($this->ah,$t);
            array_shift($this->ah);
            array_unshift($this->ah,$t);
            $this->CF = $this->CF ^ $t ^ $s;
        }
        $this->ah = bindec($this->ah);
        $t = 0;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function run() {     // run file on linux $ST0 is command and arguments are $string
                   
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];// $rdx is the output file to show what happened.
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B ". $this->ST0 . " " . $this->string, "r"));
        } else {
            exec($this->ST0 . " " . $this->string . " > /dev/null &", $this->output, $this->cl);
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function run_pop() {     // same as above but pop
                   
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];// again, $rdx is the output
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B ". $this->ST0 . " " . $this->string . " > " . $this->rdx, "r"));
        } else {
            exec($this->ST0 . " " . $this->string . " > /dev/null &", $this->output, $this->cl);
        }
        array_pop($this->stack);
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_flags()     // set flags from ah bits [0,2]
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->OF = $this->ah%2;
        $this->ah >>= 1;
        $this->CF = $this->ah%2;
        $this->ah >>= 1;
        $this->ZF = $this->ah%2;
        $this->ah >>= 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function bitwisel()  // bitewise left
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx <<= $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function bitewiser() // same right
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->ecx >>= $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function scan_str()  // next(string);
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->strp = next($this->string);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function reset_str()  // next(string);
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        reset($this->string);
        $this->strp = current($this->string);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set($key, $new_value)   // set $key with $new_value
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->$key = $new_value;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ecx_adx()   // copy adx to ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ecx = $this->adx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ecx_rdx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ecx = $this->rdx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ecx_bdx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ecx = $this->bdx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ecx_cdx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ecx = $this->cdx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ecx_ddx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ecx = $this->ddx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ecx_edx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ecx = $this->edx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ah_adx()   // copy adx to ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ah = $this->adx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ah_rdx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ah = $this->rdx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ah_bdx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ah = $this->bdx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ah_cdx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ah = $this->cdx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ah_ddx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ah = $this->ddx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function set_ah_edx()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        try {
            $this->ah = $this->edx;
        }
        catch (\Exception $e)
        {
            echo "#Register $this->key not in object...<br>Failing...";
            exit();
        }
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function seta()  // set if ah is above ecx
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah > $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setae()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah >= $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setb()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah < $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setbe()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah <= $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setc()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->CF != 0)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function sete()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah == $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setg()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah > $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setge()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah >= $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setl()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah < $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setle()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah <= $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setna()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah < $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnae()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah > $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnb()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah > $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnbe()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah >= $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnc()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->CF == 0)
            $this->cl = 1;
        else
            return new static;
         if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setne()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah != $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setng()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah <= $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnge()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah < $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnl()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah >= $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnle()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah > $this->ecx)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setno()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->OF != 1)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setnp()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if (decbin($this->ah) != decbin($this->ecx))
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setns()  // if $ah >= 0 set rdx to ah
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah >= 0)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function seto()
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->OF == 1)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setp()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if (decbin($this->ecx) != decbin($this->ah))
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setpe()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if (decbin($this->ecx) != decbin($this->ah) && $this->cl%2 == 0)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setpo()
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if (decbin($this->ecx) != decbin($this->ah) && $this->cl%2 == 1)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function sets()  // if $ah < 0 set rdx to ah
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah < 0)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setz()  // if $ah == 0 set rdx to ah
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        if (!is_int($this->ah) || !is_int($this->ecx)) {
            echo "Error in " . __METHOD__ . ": Incomparable types";
            exit(0);
        }
        
        $this->args[] = func_get_args();

        if ($this->ah == 0)
            $this->cl = 1;
        else
            return new static;
        $this->rdx = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function setcf()     // set CF to 1
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->CF = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function add_to_buffer() // continue buffer string
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->buffer .= $this->string;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function clear_buffer()  // clears $buffer
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $this->buffer = "";
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function save_stack_file()   // save state of $stack to file $string
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        file_put_contents($this->string, serialize(($this->stack)));
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract_byte() // subtract 8 bits
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = ($this->ecx - $this->ah)%256;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract_word()     // subtract 16 bits
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = ($this->ecx - $this->ah)%pow(2,16);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract_double()   // subtract 32 bits
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = ($this->ecx - $this->ah)%pow(2,32);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function subtract_quad() // subtract 64 bits
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->rdx = ($this->ecx - $this->ah)%pow(2,64);
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function load_cl()   // push ah to cl
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $this->cl = $this->ah;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function test_compare() // peek at comparison
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ah == $this->ecx)
            $this->cl = 0;
        else if ($this->ah > $this->ecx)
            $this->cl = 1;
        else if ($this->ah >= $this->ecx)
            $this->cl = 2;
        else if ($this->ah < $this->ecx)
            $this->cl = 3;
        else if ($this->ah <= $this->ecx)
            $this->cl = 4;
            if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function thread() // thread php pages on demand on linux
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $x = "?";
        foreach ($this->ST0 as $key => $value)
        {
            $x .= "&$key=$value";
        }
        exec("php $this->string/$x > /dev/null &");
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function xadd()  // ah = $ah + ecx && rdx = ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $temp = $this->ah;
        $this->rdx = $this->ah;
        $this->ah = $temp + $this->ecx;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function exchange()  // reverse ecx and ah
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $temp = $this->ah;
        $this->ecx = $this->ah;
        $this->ah = $temp;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function xor() // xor $ah and ecx
    {
        $method_del = explode("::", __METHOD__);
         {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        if ($this->ah xor $this->ecx)
            $this->rdx = 1;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function popcnt()    // pop $ah times
    {
        $method_del = explode("::", __METHOD__);
        {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }

        $counter = count($this->stack);
        while (count($this->stack) > 0 && $this->ah < --$counter)
            array_pop($this->stack);
        $this->cl = 1;
        $this->ST0 = $this->stack[array_key_last($this->stack)];
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function stack_func() {  // do top of stack as function
        $method_del = explode("::", __METHOD__);
        {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $this->ST0();
            
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }

    public function stack_func_pos() {  // sync stack pointer
        $this->sp = current($this->stack);
        $method_del = explode("::", __METHOD__);
        {
            $this->chain[$this->counter] = $method_del[1];
        
            foreach (func_get_args() as $key => $val) 
                $this->args = array_merge($this->args,array($key => $val));
            $this->counter++;
        }
        $this->sp();
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }
    
    public function create_register(string $register, $value) // create a new variable "register"
    {
        $method_del = explode("::", __METHOD__);
        $this->chain[] = $method_del[1];
        $this->args[] = func_get_args();

        $this->$register = $value;
        if ($this->pdb == 1)
            echo $this->lop . " ";
        $this->lop++;
        return new static;
    }
}

?>