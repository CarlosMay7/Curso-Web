# Reglas de normalización SQL
## Está bien no siempre aplicar las reglas de normalización según el proyecto, a esto se le llama denormalización.
### 1NF
- Cada columna debe tener un valor y sin valores repetidos
### 2NF
- La llave primaria compuesta no se puede duplicar
Así que se puede hacer otra tabla donde se tenga la llave primaria y otra con la foránea
### 3NF
- Si en losdatos que no son llaves primarias hay repeticiones se crea otra tabla en donde se tenga la relación a esos datos y evitar la repetición