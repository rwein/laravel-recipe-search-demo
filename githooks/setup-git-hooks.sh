#!/bin/bash

# Set up our pre-commit step
cp pre-commit ../.git/hooks/pre-commit
chmod +x ../.git/hooks/pre-commit

echo "Git hooks installed successfully."
