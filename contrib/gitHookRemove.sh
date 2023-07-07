#!/bin/sh

if [ -e .git/hooks/pre-commit ];
then
    PRE_COMMIT_EXISTS=1
else
    PRE_COMMIT_EXISTS=0
fi

echo "-------------------------------------------------"

if [ "$PRE_COMMIT_EXISTS" = 1 ];
then
    rm -f .git/hooks/pre-commit
    echo "Pre-commit git hook has been removed."
else
    echo "Pre-commit git hook doesn't exits! Nothing to do."
fi

echo "-------------------------------------------------"
