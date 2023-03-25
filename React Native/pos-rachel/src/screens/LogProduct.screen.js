import React, { Fragment, useState, useEffect, createContext } from "react"
import { Text, View, Dimensions, TouchableHighlight, Image, TextInput, SafeAreaView, ActivityIndicator, ToastAndroid } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon, SearchIcon } from "react-native-heroicons/solid"
import { TagIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import ItemTagBar from "../components/molecules/ItemTagBar.molecule"
import Drawer from "../components/organisms/Drawer.organism"
import ListProduct from "../components/organisms/ListProduct.organism"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"
import Axios from "../configs/axios/Axios.config"
import AsyncStorage from "@react-native-async-storage/async-storage"

const TagContext = createContext()
const { Provider } = TagContext

const LogProduct = ({ changeDrawerStatus, navigation, products, rangeProduct, categories, changeRangeProduct, idProductUpdate, changeIdProductUpdate, changeProducts }) => {
    const [height, setHeight] = useState(0)
    const [widthScreen, setWidthScreen] = useState(0)
    const [tag, setTag] = useState("Produk")
    const [productUpdate, setProductUpdate] = useState({})
    const [isLoading, setIsLoading] = useState(false)

    useEffect(() => {
        console.log(rangeProduct)

        return () => {
            changeRangeProduct(10)
        }
    }, [])

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    useEffect(() => {
        changeDrawerStatus(false)
        setWidthScreen(() => Dimensions.get("screen").width)

        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })
    }, [])

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    const getData = () => {
        const data = products.slice(0, rangeProduct)

        return data
    }

    useEffect(() => {
        if(idProductUpdate) {
            products.forEach(item => {
                if(item.id === idProductUpdate) {
                    setProductUpdate(item)
                }
            })
        }
    }, [idProductUpdate])

    const ProductTab = () => {
        return (
            <Fragment>
                <SafeAreaView>
                    {
                        products.length ? 
                            <ListProduct
                                data={ getData() }
                                canAction={ false }
                            /> :
                            <View style={ Tailwind`flex flex-col items-center mt-20 mb-30` }>
                                <Image
                                    source={ require("../assets/ilustrations/box.png") }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-50 h-50` }
                                />
                                <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                                    Belum Ada Produk
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                    Pilih "Tambah Produk" untuk menambahkan produk kamu ke dalam inventori.
                                </Text>
                            </View>
                    }
                </SafeAreaView>
            </Fragment>
        )
    }

    const CategorieTab = () => {
        return (
            <Fragment>
                <View style={ Tailwind`w-full` }>
                    {
                        categories.length ? 
                            React.Children.toArray(categories.map(categorie => {
                                return (
                                    <View style={ Tailwind`w-full flex flex-row items-center py-3 border-b border-gray-200` }>
                                        <TagIcon size={ 22 } style={ Tailwind`text-primary--red mr-2` }/>
                                        <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                            { categorie.name }
                                        </Text>
                                    </View>
                                )
                            })) :
                            <View style={ Tailwind`flex flex-col items-center mt-20 mb-30` }>
                                <Image
                                    source={ require("../assets/ilustrations/folder.png") }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-50 h-50` }
                                />
                                <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                                    Belum Ada Kategori
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                    Pilih "Tambah Kategori" untuk menambahkan kategori dan mengelola produk anda.
                                </Text>
                            </View>
                    }
                </View>
            </Fragment>
        )
    }

    const handleUpdate = async () => {
        const token = await AsyncStorage.getItem("token")

        setIsLoading(true)

        try {
            const response = await Axios.put(
                "/vendor/item/update",
                {
                    id: productUpdate.id,
                    current_stock: productUpdate.stock,
                    price: productUpdate.price.toString().split(",").length ? parseInt(productUpdate.price.toString().split(",").join("")) : productUpdate.price
                },
                {
                    headers: {
                        "Authorization": `Bearer ${ JSON.parse(token) }`
                    }
                }
            )

            let dataUpdate = []

            products.forEach((item) => {
                if(item.id == idProductUpdate) {
                    dataUpdate.push({
                        id: response.data.update_data.id,
                        sku_id: response.data.update_data.sku_id,
                        name: response.data.update_data.name,
                        price: response.data.update_data.price,
                        stock: response.data.update_data.stock,
                        category_id: response.data.update_data.category_id,
                        module_id: response.data.update_data.module_id
                    })
                } else {
                    dataUpdate.push(item)
                }
            })

            changeProducts([...dataUpdate])
            await AsyncStorage.setItem("products", JSON.stringify(dataUpdate))

            ToastAndroid.show("Success update product.", 1500)
        } catch (error) {
            ToastAndroid.show("Failed when update product.", 1500)
            console.log(error.message)
        } finally {
            setProductUpdate({})
            changeIdProductUpdate(null)
            setIsLoading(false)
        }
    }

    return (
        <Fragment>
            <Provider value={ { tag, setTag } }>
                <Drawer/>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                    <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                        <View style={ Tailwind`flex flex-row items-center` }>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-md` } onPress={ () => changeDrawerStatus(true) }>
                                <MenuIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                            </TouchableHighlight>
                            <View style={ Tailwind`${ handleResponsive(["w-40 ml-6","w-80 ml-5"]) } px-3 py-2 rounded-md bg-gray-100 flex flex-row items-center border border-primary--red` }>
                                <SearchIcon size={ 22 } style={ Tailwind`text-primary--red opacity-70` }/>
                                <TextInput
                                    scrollEnabled={ false }
                                    placeholder={ "Cari Produk" }
                                    style={ Tailwind`p-0 text-sm text-primary--red flex-grow ml-3 tracking-wide font-rubik-regular` }
                                    placeholderTextColor={ "#F2414180" }
                                />
                            </View>
                        </View>
                        <Image
                            source={ { uri: "https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FydG9vbnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" } }
                            resizeMode={ "contain" }
                            style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                        />
                    </View>
                    <View style={ [Tailwind`w-full flex flex-col items-center p-6 bg-white rounded-2xl mt-6`, { height: height - 130 }] }>
                        <View style={ Tailwind`flex flex-row items-center w-full` }>
                            <ItemTagBar text={ "Produk" } context={ TagContext }/>
                            <View style={ Tailwind`w-5` }/>
                            <ItemTagBar text={ "Kategori" } context={ TagContext }/>
                        </View>
                        <View style={ Tailwind`flex-1 w-full mt-3` }>
                            { 
                                { "Produk": ProductTab(), "Kategori": CategorieTab() }[tag]
                            }
                        </View>
                    </View>
                </View>
                {
                    idProductUpdate !== null ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col` }>
                                <View style={ Tailwind`w-full flex flex-col` }>
                                    <View style={ Tailwind`flex flex-row items-center justify-between` }>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                            Update Produk
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-medium text-base text-primary--red` }>
                                            #{ productUpdate.id }
                                        </Text>
                                    </View>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80 text-left mt-1` }>
                                        Note: Hanya bisa merubah stok dan harga dari barang.
                                    </Text>
                                    <View style={ Tailwind`w-full mt-5 mb-2 h-px bg-gray-200` }/>
                                    {
                                        Object.keys(productUpdate).length ? 
                                            <View>
                                                <Text style={ Tailwind`font-roboto-regular text-xs text-accent--black mt-3` }>Stok</Text>
                                                <TextInput
                                                    placeholder="Stok"
                                                    style={ Tailwind`w-full py-4 bg-gray-100 px-4 rounded-md font-rubik-regular mt-2` }
                                                    keyboardType={ "numeric" }
                                                    value={ productUpdate.stock.toString() }
                                                    onChangeText={ (value) => setProductUpdate({ ...productUpdate, stock: value }) }
                                                />
                                                <Text style={ Tailwind`font-roboto-regular text-xs text-accent--black mt-3` }>Harga</Text>
                                                <TextInput
                                                    placeholder="Harga"
                                                    style={ Tailwind`w-full py-4 bg-gray-100 px-4 rounded-md font-rubik-regular mt-2` }
                                                    keyboardType={ "numeric" }
                                                    value={ productUpdate.price.toString() }
                                                    onChangeText={ (value) => setProductUpdate({ ...productUpdate, price: value }) }
                                                    onEndEditing={ () => setProductUpdate({ ...productUpdate, price: productUpdate.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }) }
                                                    onTouchStart={ () => setProductUpdate({ ...productUpdate, price: typeof(productUpdate.price) == typeof("str") ? parseInt(productUpdate.price.split(",").join("")) : productUpdate.price }) }
                                                />
                                            </View> : <ActivityIndicator size={ "large" } color={ "#191919" }/>
                                    }
                                </View>
                                <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => {
                                        changeIdProductUpdate(null)
                                        setProductUpdate({})
                                    } }>
                                        <ButtonSecondary text={ "Kembali" }/>
                                    </TouchableHighlight>
                                    <View style={ Tailwind`w-2` }/>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => handleUpdate() }>
                                        <ButtonPrimary text={ "Update" }/>
                                    </TouchableHighlight>
                                </View>
                            </View>
                        </View> : null
                }
                {
                    isLoading ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: Dimensions.get("screen").height }] }>
                            <ActivityIndicator color={ "#FFFFFF" } size={ "large" }/>
                        </View> : null
                }
            </Provider>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        products : state.products,
        categories : state.categories,
        rangeProduct: state.rangeProduct,
        idProductUpdate: state.idProductUpdate
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
        changeRangeProduct : (value) => dispatch({type: 'CHANGE_RANGEPRODUCT', newValue: value}),
        changeIdProductUpdate : (value) => dispatch({type: 'CHANGE_IDPRODUCTUPDATE', newValue: value}),
        changeProducts: (value) => dispatch({type: 'CHANGE_PRODUCTS', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(LogProduct)