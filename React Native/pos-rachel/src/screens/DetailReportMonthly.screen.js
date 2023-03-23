import React, { Fragment, useState, useEffect } from "react"
import { SafeAreaView, ScrollView, View, Image, TouchableHighlight, Text, Dimensions, ActivityIndicator } from "react-native"
import { ArrowLeftIcon, DownloadIcon, ArrowDownIcon } from "react-native-heroicons/solid"
import { connect } from "react-redux"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import ReportFetching from "../libs/fetching/ReportFetching.lib"

const DetailReportMonthly = ({ navigation, user, route }) => {
    const [height, setHeight] = useState(0)
    const [isLoading, setIsLoading] = useState(false)
    const [dirtPrice, setDirtPrice] = useState(0)
    const [discount, setDiscount] = useState(0)
    const [clearPrice, setClearPrice] = useState(0)
    const [tax, setTax] = useState(0)
    const [totalPrice, setTotalPrice] = useState(0)
    const [totalModal, setTotalModal] = useState(0)
    const [benefit, setBenefit] = useState(0)
    const [products, setProducts] = useState([])
    const [indexDetail, setIndexDetail] = useState(null)

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    useEffect(() => {
        async function initData() {
            setIsLoading(true)
            const response = await ReportFetching().detailMonthlyReport(route.params.data.date)

            if(response[0].list_order.length) {
                let resultProducts = []

                response[0].list_order.forEach(report => {
                    report.detail_order.forEach(detail => {
                        if(resultProducts.length) {
                            let exist = null

                            resultProducts.forEach((product, index) => {
                                if(product.id === detail.item.id) {
                                    exist = index
                                }
                            })

                            if(exist !== null) {
                                resultProducts[exist].qty = resultProducts[exist].qty + detail.qty
                                resultProducts[exist].price = resultProducts[exist].price + detail.price
                            } else {
                                resultProducts.push({
                                    id: detail.item.id,
                                    name: detail.item.name,
                                    qty: detail.qty,
                                    price: detail.price,
                                    item: detail.item
                                })
                            }
                        } else {
                            resultProducts.push({
                                id: detail.item.id,
                                name: detail.item.name,
                                qty: detail.qty,
                                price: detail.price,
                                item: detail.item
                            })
                        }
                    })
                })

                setProducts([...resultProducts])
                setDirtPrice(response[0].total_kotor)
                setTax(response[0].total_pajak)
                setDiscount(response[0].total_diskon)
                setClearPrice(response[0].total_bersih)
                setTotalPrice(response[0].total_sales)
                setTotalModal(response[0].total_modal)
                setBenefit(response[0].total_keuntungan)
            }

            setIsLoading(false)
        }

        initData()
    }, [])

    const renderMonth = (param) => {
        const months = Object.freeze({
            "01": "January",
            "02": "February",
            "03": "Maret",
            "04": "April",
            "05": "Mei",
            "06": "Juni",
            "07": "Juli",
            "08": "Agustus",
            "09": "September",
            "10": "Oktober",
            "11": "November",
            "12": "Desember",
        })

        return months[param.toString()]
    }

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                    <ScrollView showsVerticalScrollIndicator={ false }>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6 mb-6` }>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-md` } onPress={ () => navigation.goBack() }>
                                    <ArrowLeftIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                    Ringkasan
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <Image
                                    source={ { uri: user.avatar } }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                />
                            </View>
                        </View>
                        <View style={ Tailwind`w-full bg-white p-6 flex flex-col rounded-2xl` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-lg text-accent--black` }>
                                    Ringkasa Penjualan Bulan { renderMonth(route.params.data.date.split(" ")[0].split("-")[1]) }
                                </Text>
                                <View style={ Tailwind`flex flex-row items-center p-3 rounded-lg bg-primary--red` }>
                                    <DownloadIcon size={ 22 } style={ Tailwind`text-white` }/>
                                    <Text style={ Tailwind`font-rubik-regular text-sm text-white ml-2` }>
                                        Download Laporan
                                    </Text>
                                </View>
                            </View>
                            <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                            <View style={ Tailwind`w-full flex flex-row` }>
                                <View style={ Tailwind`flex-1 flex flex-col` }>
                                    <Text style={ Tailwind`font-rubik-medium text-base text-primary--red` }>
                                        Penjualan
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-50` }>
                                        (Penjualan - Diskon) + Pajak
                                    </Text>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between px-4 py-2 bg-gray-200 mt-5` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                            Keterangan
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                            Jumlah
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Penjualan Kotor
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Rp{ dirtPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full h-px bg-gray-200` }/>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Diskon
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Rp{ discount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between px-4 py-2 bg-red-200` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-primary--red` }>
                                            Total Penjualan Bersih
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-primary--red` }>
                                            Rp{ clearPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Pajak
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Rp{ tax.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between px-4 py-2 bg-primary--red` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-white` }>
                                            Total Penjualan
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-white` }>
                                            Rp{ totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                </View>
                                <View style={ Tailwind`w-5` }/>
                                <View style={ Tailwind`flex-1 flex flex-col` }>
                                    <Text style={ Tailwind`font-rubik-medium text-base text-primary--red` }>
                                        Keuntungan
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-50` }>
                                        Total Penjualan Bersih - Harga Modal Produk
                                    </Text>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between px-4 py-2 bg-gray-200 mt-5` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                            Keterangan
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                            Jumlah
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Total Penjualan
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Rp{ totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full h-px bg-gray-200` }/>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Harga Modal Produk
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                            Rp{ totalModal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between px-4 py-2 bg-green-200` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-green-600` }>
                                            Total Keuntungan
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-green-500` }>
                                            Rp{ benefit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                        </Text>
                                    </View>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-50 leading-relaxed tracking-wide mt-5` }>
                                        *Berikut ini merupakan total penjualan produk selama sebulan, belum termasuk pengeluaran biaya operasional. Jadi bukan hitungan omset toko secara keseluruhan.
                                    </Text>
                                </View>
                            </View>
                            <Text style={ Tailwind`font-rubik-medium text-lg text-accent--black mt-10` }>
                                Detail Produk Terjual
                            </Text>
                            <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between bg-gray-200 px-5 py-3` }>
                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black flex-1` }>
                                    Nama Produk
                                </Text>
                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black flex-1 text-center` }>
                                    Qty
                                </Text>
                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black flex-1 text-center` }>
                                    Penjualan Kotor
                                </Text>
                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black flex-1 text-right` }>
                                    Action
                                </Text>
                            </View>
                            {
                                React.Children.toArray(products.map(((product, index) => {
                                    return (
                                        <View>
                                            <View style={ Tailwind`w-full flex flex-row items-center justify-between bg-gray-100 px-5 py-3` }>
                                                <Text style={ Tailwind`font-rubik-regular text-base text-accent--black flex-1` }>
                                                    { product.name }
                                                </Text>
                                                <Text style={ Tailwind`font-rubik-regular text-base text-accent--black flex-1 text-center` }>
                                                    { product.qty }pcs
                                                </Text>
                                                <Text style={ Tailwind`font-rubik-regular text-base text-accent--black flex-1 text-center` }>
                                                    Rp{ product.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                                </Text>
                                                <View style={ Tailwind`flex-1 items-end` }>
                                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIndexDetail(indexDetail == index ? null : index) }>
                                                        <ArrowDownIcon size={ 20 } style={ Tailwind`text-accent--black` }/>
                                                    </TouchableHighlight>
                                                </View>
                                            </View>
                                            {
                                                indexDetail == index ?
                                                    <View>
                                                        <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                SKU Produk
                                                            </Text>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                { product.item.sku_id }
                                                            </Text>
                                                        </View>
                                                        <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                Kategori
                                                            </Text>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                { product.item.kategori }
                                                            </Text>
                                                        </View>
                                                        <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                Pajak
                                                            </Text>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                Rp{ product.item.tax }
                                                            </Text>
                                                        </View>
                                                        <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                Harga Produk (pcs)
                                                            </Text>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                Rp{ product.item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                                            </Text>
                                                        </View>
                                                        <View style={ Tailwind`w-full flex flex-row items-center justify-between p-4` }>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                Penjualan
                                                            </Text>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                                                Rp{ product.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                                            </Text>
                                                        </View>
                                                    </View> : null
                                            }
                                        </View>
                                    )
                                })))
                            }
                        </View>
                        <View style={ Tailwind`h-12` }/>
                    </ScrollView>
                </View>
                {
                    isLoading ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: Dimensions.get("screen").height }] }>
                            <ActivityIndicator color={ "#FFFFFF" } size={ "large" }/>
                        </View> : null
                }
            </SafeAreaView>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        user : state.user
    }
}

export default connect(mapStateToProps, null)(DetailReportMonthly)