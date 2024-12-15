import React, { useEffect, useState } from "react";
import axios from "axios";
import { useParams } from "react-router-dom";
import "../ProductDetails.css"; 

function ProductDetail() {
  const { id } = useParams(); // Obtém o ID do produto da URL
  const [product, setProduct] = useState(null);

  useEffect(() => {
    // Obtém os detalhes do produto a partir da API
    axios
      .get(`http://127.0.0.1:8000/api/products/${id}`)
      .then((response) => {
        setProduct(response.data);
      })
      .catch((error) => {
        console.error("Erro ao obter o produto", error);
      });
  }, [id]);

  if (!product) {
    return <div className="loading">Carregando...</div>;
  }

  return (
    <div className="product-details">
      <h1 className="product-title">{product.name}</h1>
      <div className="product-info">
        <table className="product-table">
          <tbody>
            <tr>
              <th>Descrição</th>
              <td>{product.description}</td>
            </tr>
            <tr>
              <th>Preço</th>
              <td>R$ {Number(product.price).toFixed(2)}</td>
            </tr>
            <tr>
              <th>Quantidade</th>
              <td>{product.quantity}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td>
                <span
                  className={`status-label ${
                    product.active ? "active" : "inactive"
                  }`}
                >
                  {product.active ? "Ativo" : "Inativo"}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  );
}

export default ProductDetail;
