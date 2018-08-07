<?php

function almostSorted(array $arr): void
{
    $s = null;
    $f = null;
    $c = 0;

    for ($i = 1, $max = count($arr) - 1; $i <= ceil($max / 2); $i++) {
        if ((is_null($s) || $i - 1 < $s) && $arr[$i - 1] > $arr[$i]) {
            if (is_null($s)) {
                $c++;
            }

            $s = $i - 1;
        } elseif (!is_null($s) && (is_null($f) || $max - $i + 1 > $f) && $arr[$i - 1] > $arr[$i]) {
            if (is_null($f)) {
                $c++;
            }

            $f = $i;
        }

        if ((is_null($f) || $max - $i + 1 > $f) && $arr[$max - $i + 1] < $arr[$max - $i]) {
            if (is_null($f)) {
                $c++;
            }

            $f = $max - $i + 1;
        } elseif (!is_null($f) && (is_null($s) || $i - 1 < $s) && $arr[$max - $i + 1] < $arr[$max - $i]) {
            if (is_null($s)) {
                $c++;
            }

            $s = $max - $i;
        }
    }

    if (!is_null($s) && is_null($f)) {
        $f = $s + 1;
        $c++;
    }

    if (is_null($s) && !is_null($f)) {
        $s = $f - 1;
        $c++;
    }

    if ($c !== 2) {
        echo 'no';
        return;
    }

    if (
        $s + 1 === $f
        && $arr[$f] <= $arr[$s]
        && ($max === 1 || ($max >= 1 && $arr[$s] <= ($arr[$f + 1] ?? $arr[$f])))
        && ($max === 1 || ($max >= 1 && $arr[$f] >= ($arr[$s - 1] ?? $arr[$s])))
    ) {
        echo 'yes' . "\n" . sprintf('swap %1$d %2$d', $s + 1, $f + 1);
        return;
    }

    if ($s - 1 < 1) {
        $s = 1;
    }

    if ($arr[$s - 1] <= $arr[$f] && $arr[$f - 1] <= $arr[$s]) {
        $status = true;
        for ($i = $s + 2; $i <= $f; $i++) {
            if ($arr[$i - 1] < $arr[$i]) {
                $status = false;
                break;
            }
        }

        if ($status) {
            echo 'yes' . "\n" . sprintf('reverse %1$d %2$d', $s + 1, $f + 1);
            return;
        }

        echo 'yes' . "\n" . sprintf('swap %1$d %2$d', $s + 1, $f + 1);
        return;
    }

    echo 'no';
    return;
}

