import React, { Fragment, useState, useEffect } from "react"
import { View, Text, TouchableHighlight, Image } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { PlusIcon } from "react-native-heroicons/solid"
import { Picker } from "@react-native-picker/picker"
import ListProduct from "./ListProduct.organism"
import { useNavigation } from "@react-navigation/native"

const ProductView = ({ widthComponent, products, categories, keywordProduct, rangeProduct, changeRangeProduct }) => {
    const navigation = useNavigation()
    const [selectedCategorie, setSelectedCategorie] = useState()

    const getProductsCategorie = () => {
        let results = []
        let arrSlice = products.slice(0, rangeProduct)

        if(selectedCategorie) {
            arrSlice.forEach(product => {
                if(product.category_id === selectedCategorie) return results.push(product)
            })
        } else {
            if(keywordProduct) {
                results = products
            } else {
                results = arrSlice
            }
        }

        return results
    }

    const getByKeyword = () => {
        const data = getProductsCategorie()

        if(data.length) {
            const result = data.filter((item) => {
                return item.name.toLowerCase().includes(keywordProduct.toLowerCase()) || item.sku_id.toString().toLowerCase().includes(keywordProduct.toString().toLowerCase())
            })
    
            return result
        }

        return []
    }

    useEffect(() => {
        return () => {
            changeRangeProduct(10)
        };
    }, []);

    return (
        <Fragment>
            <View style={ [Tailwind`flex-grow flex flex-col`, { width: widthComponent }] }>
                <View style={ Tailwind`w-full border border-gray-200 rounded-md` }>
                    <Picker
                        selectedValue={ selectedCategorie }
                        mode={ "dropdown" }
                        dropdownIconColor={ "#1B1A17" }
                        onValueChange={ (item) => {
                            setSelectedCategorie(item)
                        } }
                    >
                        <Picker.Item label={ "Pilih Kategori" } value={ null }/>
                        {
                            React.Children.toArray(categories.map((categorie) => {
                                return <Picker.Item label={ categorie.name } value={ categorie.id }/>
                            }))
                        }
                    </Picker>
                </View>
                {
                    Array.isArray(products) && Array.from(getProductsCategorie()).length ? 
                        <View style={ Tailwind`flex-grow w-full mt-2` }>
                            <ListProduct data={ keywordProduct ? getByKeyword() : getProductsCategorie() } canAction={ true }/>
                        </View> : 
                        <View style={ [Tailwind`flex-grow flex flex-col items-center justify-center`, { width: widthComponent }] }>
                            <Image
                                source={ require("../../assets/ilustrations/box.png") }
                                resizeMode={ "contain" }
                                style={ Tailwind`w-50 h-50` }
                            />
                            <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                                Belum Ada Produk
                            </Text>
                            <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                Pilih "Tambah Produk" untuk menambahkan produk kamu ke dalam inventori.
                            </Text>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full mt-5` } onPress={ () => navigation.push("AddProduct") }>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <PlusIcon size={ 22 } style={ Tailwind`text-accent--black opacity-30 mr-2` }/>
                                    <Text style={ Tailwind`font-rubik-medium text-primary--red text-xs` }>
                                        Tambah Produk
                                    </Text>
                                </View>
                            </TouchableHighlight>
                        </View>
                }
            </View>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        widthComponent : state.widthComponent,
        products: state.products,
        categories: state.categories,
        keywordProduct: state.keywordProduct,
        rangeProduct: state.rangeProduct
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeRangeProduct : (value) => dispatch({type: 'CHANGE_RANGEPRODUCT', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ProductView)