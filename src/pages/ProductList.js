import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import "../ProductList.css"

function ProductList() {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Obtém todos os produtos da API
    axios
      .get("http://127.0.0.1:8000/api/products") // Substitua pelo endpoint correto
      .then((response) => {
        setProducts(response.data);
      })
      .catch((error) => {
        console.error("Erro ao obter os produtos", error);
      });
  }, []);

  return (
    <div className="product-list-container">
      <h1>Lista de Produtos</h1>
      <table className="product-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          {products.map((product) => (
            <tr key={product.id}>
              <td>{product.id}</td>
              <td>{product.name}</td>
              <td>R$ {Number(product.price).toFixed(2)}</td> {/* Formatação de preço */}
              <td>
                <Link to={`/products/${product.id}`}>
                  <button className="view-details-button">Ver Detalhes</button>
                </Link>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default ProductList;