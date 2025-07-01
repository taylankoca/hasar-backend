<?php

namespace App\Http\Controllers;

/**
 * @OA\Schema(
 *   schema="Customer",
 *   type="object",
 *   @OA\Property(property="customerType", type="string", enum={"Bireysel","Kurumsal"}),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="surname", type="string"),
 *   @OA\Property(property="email", type="string", format="email"),
 *   @OA\Property(property="phone", type="string"),
 *   @OA\Property(property="address", type="string"),
 *   @OA\Property(property="createdAt", type="string", format="date"),
 *   @OA\Property(property="tckn", type="string"),
 *   @OA\Property(property="vkn", type="string"),
 * )
 *
 * @OA\Schema(
 *   schema="CustomerInput",
 *   type="object",
 *   required={"customerType","name","email","phone","address"},
 *   @OA\Property(property="customerType", type="string", enum={"Bireysel","Kurumsal"}),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="surname", type="string"),
 *   @OA\Property(property="email", type="string", format="email"),
 *   @OA\Property(property="phone", type="string"),
 *   @OA\Property(property="address", type="string"),
 *   @OA\Property(property="tckn", type="string"),
 *   @OA\Property(property="vkn", type="string"),
 * )
 *
 * @OA\Schema(
 *   schema="Invoice",
 *   type="object",
 *   @OA\Property(property="invoiceNo", type="string"),
 *   @OA\Property(property="customerKey", type="string", format="email"),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="surname", type="string"),
 *   @OA\Property(property="amount", type="number", format="float"),
 *   @OA\Property(property="dueDate", type="string", format="date"),
 *   @OA\Property(property="paymentType", type="string", enum={"Credit Card","PayPal","Bank Transfer"}),
 *   @OA\Property(property="status", type="string", enum={"Pending","Paid","Overdue"}),
 * )
 *
 * @OA\Schema(
 *   schema="InvoiceInput",
 *   type="object",
 *   required={"customerKey","invoiceNo","amount","dueDate","paymentType"},
 *   @OA\Property(property="customerKey", type="string", format="email"),
 *   @OA\Property(property="invoiceNo", type="string"),
 *   @OA\Property(property="amount", type="number", format="float"),
 *   @OA\Property(property="dueDate", type="string", format="date"),
 *   @OA\Property(property="paymentType", type="string", enum={"Credit Card","PayPal","Bank Transfer"}),
 * )
 *
 * @OA\Schema(
 *   schema="InvoiceUpdateInput",
 *   type="object",
 *   required={"customerKey","amount","dueDate","paymentType"},
 *   @OA\Property(property="customerKey", type="string", format="email"),
 *   @OA\Property(property="amount", type="number", format="float"),
 *   @OA\Property(property="dueDate", type="string", format="date"),
 *   @OA\Property(property="paymentType", type="string", enum={"Credit Card","PayPal","Bank Transfer"}),
 * )
 *
 * @OA\Schema(
 *   schema="UserProfile",
 *   type="object",
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="surname", type="string"),
 *   @OA\Property(property="email", type="string", format="email"),
 *   @OA\Property(property="avatarUrl", type="string", format="url"),
 * )
 *
 * @OA\Schema(
 *   schema="UserProfileInput",
 *   type="object",
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="surname", type="string"),
 *   @OA\Property(property="avatar", type="string", format="binary"),
 * )
 *
 * @OA\Schema(
 *   schema="Permission",
 *   type="object",
 *   @OA\Property(property="module", type="string", enum={"Customers","Invoices","Settings"}),
 *   @OA\Property(property="permissions", type="object",
 *     @OA\Property(property="view", type="boolean"),
 *     @OA\Property(property="create", type="boolean"),
 *     @OA\Property(property="edit", type="boolean"),
 *     @OA\Property(property="delete", type="boolean"),
 *   ),
 * )
 *
 * @OA\Schema(
 *   schema="Group",
 *   type="object",
 *   @OA\Property(property="id", type="string", format="uuid"),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="members", type="array", @OA\Items(type="string", format="email")),
 * )
 *
 * @OA\Schema(
 *   schema="DashboardSummary",
 *   type="object",
 *   @OA\Property(property="pending", type="object",
 *     @OA\Property(property="amount", type="number", format="float"),
 *     @OA\Property(property="count", type="integer"),
 *   ),
 *   @OA\Property(property="paid", type="object",
 *     @OA\Property(property="amount", type="number", format="float"),
 *     @OA\Property(property="count", type="integer"),
 *   ),
 *   @OA\Property(property="overdue", type="object",
 *     @OA\Property(property="amount", type="number", format="float"),
 *     @OA\Property(property="count", type="integer"),
 *   ),
 * )
 *
 * @OA\Schema(
 *   schema="PerformanceChartData",
 *   type="array",
 *   @OA\Items(type="object",
 *     @OA\Property(property="status", type="string", enum={"Pending","Paid","Overdue"}),
 *     @OA\Property(property="total", type="number", format="float"),
 *   )
 * )
 *
 * @OA\Schema(
 *   schema="PaymentMethodsChartData",
 *   type="array",
 *   @OA\Items(type="object",
 *     @OA\Property(property="name", type="string", enum={"Credit Card","PayPal","Bank Transfer"}),
 *     @OA\Property(property="count", type="integer"),
 *   )
 * )
 */
class SwaggerSchemas {} 